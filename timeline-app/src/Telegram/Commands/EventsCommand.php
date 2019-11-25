<?php

namespace Longman\TelegramBot\Commands\SystemCommands;

use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Request;

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
        $text    = 'Will you go to SAMPLE EVENT?';

        $data = [
            'chat_id' => $chat_id,
            'text' => $text,
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    [
                        ['text' => 'YES', 'callback_data' => 1],
                        ['text' => 'NO', 'callback_data' => 0],
                    ]
                ]
            ]),
        ];

        return Request::sendMessage($data);
    }
}
