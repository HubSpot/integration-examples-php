<?php


namespace Repositories;

use Helpers\DBClientHelper;

class EventsRepository
{
    public static function saveEvent($event) {
        $db = DBClientHelper::getClient();
        $query = $db->prepare("insert into events (event_id, event_type, object_id, occurred_at) values (?, ?, ?, ?)");
        $query->execute([$event['eventId'], $event['subscriptionType'], $event['objectId'], $event['occurredAt']]);
    }

    public static function findLastModifiedObjectsIds(int $from = 0, int $perPage = 0) {
        $db = DBClientHelper::getClient();
        $limit = 'LIMIT 10';
        $options = [];
        if ($perPage) {
            $limit = "LIMIT ? , ?";
            $options = [$from, $perPage];
        }
        $query = $db->prepare("SELECT object_id FROM events GROUP BY object_id ORDER BY MAX(id) DESC $limit;");
        $query->execute($options);
        $objectsIds = [];
        foreach ($query->fetchAll() as $row) {
            $objectsIds[] = $row['object_id'];
        }
        return $objectsIds;
    }


    public static function getEventsCount() {
        $db = DBClientHelper::getClient();
        $query = $db->query("select COUNT(distinct object_id) as count  from events ");
        return $query->fetchColumn(0);
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

    public static function getNotShownEventsCount(int $timestamp): int
    {
        $db = DBClientHelper::getClient();
        $query = $db->prepare("select count(*) from events where UNIX_TIMESTAMP(created_at) > ?;");
        $query->execute([$timestamp]);
        return $query->fetchColumn(0);
    }

    public static function deleteAll() {
        $db = DBClientHelper::getClient();
        $db->exec("delete from  events");
    }
}
