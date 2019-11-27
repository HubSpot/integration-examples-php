<?php

namespace Longman\TelegramBot\Commands\SystemCommands;

use Helpers\TimelineEventHelper;
use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Request;
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
            TimelineEventHelper::createEvent($invitationId, $chatId);
        }

        $data = [
            'callback_query_id' => $this->getCallbackQuery()->getId(),
            'text'              => $invitationReply->getReply(),
            'cache_time'        => 5,
        ];

        return Request::answerCallbackQuery($data);
    }
}
