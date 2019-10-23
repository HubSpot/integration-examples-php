<?php


namespace Repositories;

use Helpers\DBClientHelper;

class EventsRepository
{
    public static function createTableIfNotExists() {
        $db = DBClientHelper::getClient();
        $db->exec(
            "
create table if not exists events
(
    id INTEGER not null primary key autoincrement,
    event_type  VARCHAR,
    object_id   int      default null,
    event_id    int      default null,
    occurred_at datetime default null,
    shown       tinyint(1) default 0,
    created_at  datetime default (datetime('now', 'localtime'))
);
"
        );
    }

    public static function saveEvent($event) {
        $db = DBClientHelper::getClient();
        $query = $db->prepare("insert into events (event_id, event_type, object_id, occurred_at) values (?, ?, ?, ?)");
        $query->bindValue(1, $event['eventId']);
        $query->bindValue(2, $event['subscriptionType']);
        $query->bindValue(3, $event['objectId']);
        $query->bindValue(4, $event['occurredAt']);
        $query->execute();
    }

    public static function findLastModifiedObjectsIds() {
        $db = DBClientHelper::getClient();
        $query = $db->query("select distinct object_id from events order by occurred_at desc limit 100");
        $objectsIds = [];
        while ($row = $query->fetchArray(SQLITE3_ASSOC)) {
            $objectsIds[] = $row['object_id'];
        }
        return $objectsIds;
    }

    public static function findEventTypesByObjectId($objectId) {
        $db = DBClientHelper::getClient();
        $query = $db->prepare("select event_type from events where object_id = ? order by occurred_at asc");
        $query->bindValue(1, $objectId);
        $results = $query->execute();
        $events = [];
        while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
            $events[] = $row['event_type'];
        }
        return $events;
    }

    public static function getNotShownEventsCount() {
        $db = DBClientHelper::getClient();
        $query = $db->query("select count(*) from events where shown = 0");
        $result = $query->fetchArray();
        return $result[0];
    }

    public static function markAllEventsAsShown() {
        $db = DBClientHelper::getClient();
        $db->exec("update events set shown = 1 where shown = 0");
    }

    public static function deleteAll() {
        $db = DBClientHelper::getClient();
        $db->exec("delete from  events");
    }
}
