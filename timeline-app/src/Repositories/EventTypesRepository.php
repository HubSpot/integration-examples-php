<?php

namespace Repositories;

use Helpers\DBClientHelper;

class EventTypesRepository
{
    public static function getHubspotEventIDByCode(string $code)
    {
        $query = DBClientHelper::getClient()
                ->prepare('select hubspotEventTypeId from eventTypes where code = ?');
        $query->execute([$code]);

        return $query->fetchColumn(0);
    }

    public static function insert($type) {
        $db = DBClientHelper::getClient();
        $query = $db->prepare('insert into eventTypes (code, hubspotEventTypeId) values (?, ?)');
        $query->execute([$type['code'], $type['hubspotEventTypeId']]);
    }
}
