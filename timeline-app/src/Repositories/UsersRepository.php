<?php


namespace Repositories;

use Helpers\DBClientHelper;

class UsersRepository
{
    public static function assignEmailToTelegramChatId(string $email, int $telegramChatId) : void
    {
        $db = DBClientHelper::getClient();
        $params = [$telegramChatId, $email, $email];
        $query = $db->prepare("insert into user(telegram_chat_id, email) values (?, ?) ON DUPLICATE KEY UPDATE email = ?");
        $query->execute($params);
    }
}
