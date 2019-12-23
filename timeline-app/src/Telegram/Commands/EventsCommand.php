<?php

namespace Longman\TelegramBot\Commands\SystemCommands;

use Enums\EventTypeCode;
use Enums\UserInvitationAction;
use Helpers\TimelineEventHelper;
use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Request;
use Repositories\InvitationsRepository;
use Telegram\InvitationReply;

class EventsCommand extends SystemCommand
{
    protected $usage = '/events';

    /**
     * @throws TelegramException
     *
     * @return ServerResponse
     */
    public function execute()
    {
        $message = $this->getMessage();
        $chatId = $message->getChat()->getId();

        $data = [
            'chat_id' => $chatId,
        ];

        $invitation = InvitationsRepository::getRandom();
        if (empty($invitation)) {
            $data += [
                'text' => 'No more upcoming events :(',
            ];
        } else {
            $invitationId = $invitation['id'];
            $this->createTimelineEvent($invitationId);
            $data += [
                'text' => $invitation['text'],
                'reply_markup' => json_encode([
                    'inline_keyboard' => [
                        [
                            ['text' => 'YES', 'callback_data' => InvitationReply::encodeYesReply($invitationId)],
                            ['text' => 'NO', 'callback_data' => InvitationReply::encodeNoReply($invitationId)],
                        ],
                    ],
                ]),
            ];
        }

        return Request::sendMessage($data);
    }

    protected function createTimelineEvent($invitationId)
    {
        $chatId = $this->getMessage()->getChat()->getId();
        $action = UserInvitationAction::RECEIVED;
        TimelineEventHelper::createEvent(
            $chatId,
            EventTypeCode::USER_INVITATION_ACTION,
            [
                'name' => InvitationsRepository::getById($invitationId)['name'],
                'action' => $action,
            ]
        );
    }
}
