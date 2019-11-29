<?php

namespace Longman\TelegramBot\Commands\SystemCommands;

use Base64Url\Base64Url;
use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Request;
use Repositories\UsersRepository;
use Throwable;

class StartCommand extends SystemCommand
{
    protected $usage = '/start';

    /**
     * @throws TelegramException
     *
     * @return ServerResponse
     */
    public function execute()
    {
        $message = $this->getMessage();
        list(, $base64EncodedEmail) = explode(' ', $message->getText());
        if (!empty($base64EncodedEmail)) {
            try {
                $email = Base64Url::decode($base64EncodedEmail);
                $chatId = $this->getMessage()->getChat()->getId();
                UsersRepository::assignEmailToTelegramChatId($email, $chatId);
            } catch (Throwable $t) {
                var_dump($t->getMessage());
            }
        }

        $chat_id = $message->getChat()->getId();
        $text = 'Hi there!'.PHP_EOL.'Type /events to see available events!';

        $data = [
            'chat_id' => $chat_id,
            'text' => $text,
        ];

        return Request::sendMessage($data);
    }
}
