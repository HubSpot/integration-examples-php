<?php


namespace Helpers;

use Repositories\EventTypesRepository;
use Repositories\InvitationsRepository;
use Repositories\UsersRepository;

class TimelineEventHelper
{
    public static function createEvent(int $invitationId, int $telegramChatId) {
        $hubSpot = HubspotClientHelper::createFactory();
        $hubSpot->timeline()->createOrUpdate(
            getEnvOrException('HUBSPOT_APPLICATION_ID'),
            EventTypesRepository::getHubspotEventIDByCode('acceptedInvitation'),
            uniqid(),
            null,
            UsersRepository::getEmailByTelegramChatId($telegramChatId),
            null,
            [],
            null,
            [
                'name' => InvitationsRepository::getById($invitationId)['name'],
            ]
        );
    }
}
