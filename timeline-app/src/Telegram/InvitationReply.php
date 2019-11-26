<?php


namespace Telegram;

class InvitationReply
{
    const YES = 'yes';
    const NO = 'no';

    protected $invitationId;
    protected $reply;

    public function __construct($data)
    {
        list($this->invitationId, $this->reply) = explode('-', $data);
    }

    public function getInvitationId()
    {
        return $this->invitationId;
    }

    public function isYesReply()
    {
        return $this->reply === self::YES;
    }

    public static function encodeYesReply(int $invitationId) : string
    {
        return self::encodeReply($invitationId, self::YES);
    }

    public static function encodeNoReply(int $invitationId) : string
    {
        return self::encodeReply($invitationId, self::NO);
    }

    protected static function encodeReply(int $invitationId, string $reply) : string
    {
        return "$invitationId-$reply";
    }
}
