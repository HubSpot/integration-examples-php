<?php

namespace Longman\TelegramBot\Commands\SystemCommands;

use Helpers\HubspotClientHelper;
use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Request;
use Repositories\EventTypesRepository;
use Repositories\InvitationsRepository;
use Repositories\UsersRepository;
use Telegram\InvitationReply;

class CallbackqueryCommand extends SystemCommand
{
    /**
     * @return \Longman\TelegramBot\Entities\ServerResponse
     * @throws \Longman\TelegramBot\Exception\TelegramException
     * @throws \Exception
     */
    public function execute()
    {
        $invitationReply = new InvitationReply($this->getCallbackQuery()->getData());

        if ($invitationReply->isYesReply()) {
            $chatId = $this->getCallbackQuery()->getMessage()->getChat()->getId();
            $invitationId = $invitationReply->getInvitationId();

            $hubSpot = HubspotClientHelper::createFactory();
            $hubSpot->timeline()->createOrUpdate(
                getEnvOrException('HUBSPOT_APPLICATION_ID'),
                EventTypesRepository::getHubspotEventIDByCode('acceptedInvitation'),
                uniqid(),
                null,
                UsersRepository::getEmailByTelegramChatId($chatId),
                null,
                [],
                null,
                [
                    'name' => InvitationsRepository::getById($invitationId)['name'],
                ]
            );
        }

        $data = [
            'callback_query_id' => $this->getCallbackQuery()->getId(),
            'text'              => $invitationReply->getReply(),
            'cache_time'        => 5,
        ];

        return Request::answerCallbackQuery($data);
    }
}
