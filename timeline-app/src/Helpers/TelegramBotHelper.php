<?php
namespace Helpers;

class TelegramBotHelper
{
    public static function generateBotLink(string $email) : string
    {
        return 'https://telegram.me/'
            . getEnvOrException('TELEGRAM_BOT_USERNAME') . '?'
            . http_build_query([
                'email' => $email
            ]);
    }
}
