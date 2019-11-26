<?php

namespace Longman\TelegramBot\Commands\SystemCommands;

use Telegram\InvitationReply;
use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Request;
use Repositories\InvitationsRepository;

class EventsCommand extends SystemCommand
{
    protected $usage = '/events';

    /**
     * @return ServerResponse
     * @throws TelegramException
     */
    public function execute()
    {
        $message = $this->getMessage();

        $chat_id = $message->getChat()->getId();

        $invitation = InvitationsRepository::getRandom();

        $data = [
            'chat_id' => $chat_id,
            'text' => $invitation['text'],
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    [
                        ['text' => 'YES', 'callback_data' => InvitationReply::encodeYesReply($invitation['id'])],
                        ['text' => 'NO', 'callback_data' => InvitationReply::encodeNoReply($invitation['id'])],
                    ]
                ]
            ]),
        ];

        return Request::sendMessage($data);
    }
}
