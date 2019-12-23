<?php

use Helpers\DBClientHelper;
use Telegram\TelegramUpdatesHandler;

require __DIR__.'/../../../vendor/autoload.php';

DBClientHelper::runMigrations();

$telegramUpdatesHandler = new TelegramUpdatesHandler(
    getEnvOrException('TELEGRAM_BOT_API_TOKEN'),
    getEnvOrException('TELEGRAM_BOT_USERNAME')
);

while (true) {
    $telegramUpdatesHandler->handle();
    sleep(1);
}
