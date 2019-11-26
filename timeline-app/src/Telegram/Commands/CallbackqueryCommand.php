<?php

namespace Longman\TelegramBot\Commands\SystemCommands;

use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Request;
use Telegram\InvitationReply;

class CallbackqueryCommand extends SystemCommand
{
    /**
     * @return \Longman\TelegramBot\Entities\ServerResponse
     * @throws \Longman\TelegramBot\Exception\TelegramException
     */
    public function execute()
    {
        $invitationReply = new InvitationReply($this->getCallbackQuery()->getData());
        // pass $invitationReply and telegram_chat_id further

        $data = [
            'callback_query_id' => $this->getCallbackQuery()->getId(),
            'text'              => $invitationReply->getReply(),
            'cache_time'        => 5,
        ];

        return Request::answerCallbackQuery($data);
    }
}
