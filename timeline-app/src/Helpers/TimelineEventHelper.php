<?php

namespace Helpers;

use Repositories\EventTypesRepository;
use Repositories\UsersRepository;

class TimelineEventHelper
{
    public static function createEvent(string $telegramChatId, string $eventTypeCode, array $eventTypeData = [])
    {
        $hubSpot = HubspotClientHelper::createFactory();
        return $hubSpot->timeline()->createOrUpdate(
            getEnvOrException('HUBSPOT_APPLICATION_ID'),
            EventTypesRepository::getHubspotEventIDByCode($eventTypeCode),
            uniqid(),
            null,
            UsersRepository::getEmailByTelegramChatId($telegramChatId),
            null,
            [],
            null,
            $eventTypeData
        );
    }
}
