<?php

namespace Longman\TelegramBot\Commands\SystemCommands;

use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Request;

class CallbackqueryCommand extends SystemCommand
{
    /**
     * @return \Longman\TelegramBot\Entities\ServerResponse
     * @throws \Longman\TelegramBot\Exception\TelegramException
     */
    public function execute()
    {
        $data = [
            'callback_query_id' => $this->getCallbackQuery()->getId(),
            'text'              => $this->getCallbackQuery()->getData(),
            'cache_time'        => 5,
        ];
        return Request::answerCallbackQuery($data);
    }
}
