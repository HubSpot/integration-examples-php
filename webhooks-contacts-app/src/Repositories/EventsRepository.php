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
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    event_type  VARCHAR(255),
    object_id   int      default null,
    event_id    int      default null,
    occurred_at bigint   default null,
    shown       tinyint(1) default 0,
    created_at  datetime default CURRENT_TIMESTAMP
);
"
        );
    }

    public static function saveEvent($event) {
        $db = DBClientHelper::getClient();
        $query = $db->prepare("insert into events (event_id, event_type, object_id, occurred_at) values (?, ?, ?, ?)")
        $query->execute([$event['eventId'], $event['subscriptionType'], $event['objectId'], $event['occurredAt']]);
    }

    public static function findLastModifiedObjectsIds() {
        $db = DBClientHelper::getClient();
        $query = $db->query("SELECT object_id FROM events GROUP BY object_id ORDER BY MAX(id) DESC LIMIT 10;")
        $objectsIds = [];
        foreach ($query->fetchAll() as $row) {
            $objectsIds[] = $row['object_id'];
        }
        return $objectsIds;
    }

    public static function findEventTypesByObjectId($objectId) {
        $db = DBClientHelper::getClient();
        $query = $db->prepare("select event_type from events where object_id = ? order by occurred_at asc");
        $query->execute([$objectId]);
        $events = [];
        foreach ($query->fetchAll() as $row) {
            $events[] = $row['event_type'];
        }
        return $events;
    }

    public static function getNotShownEventsCount() {
        $db = DBClientHelper::getClient();
        $query = $db->query("select count(*) from events where shown = 0");
        $result = $query->fetchColumn(0);
        return $result;
    }

    public static function markAllEventsAsShown() {
        $db = DBClientHelper::getClient();
        $db->exec("update events set shown = 1 where shown = 0");
    }
}
