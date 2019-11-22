<?php

require __DIR__.'/../../../vendor/autoload.php';

$telegramUpdatesHandler = new \Telegram\TelegramUpdatesHandler(
    getEnvOrException('TELEGRAM_BOT_API_KEY'),
    getEnvOrException('TELEGRAM_BOT_USERNAME')
);

while (true) {
    $telegramUpdatesHandler->handle();
    sleep(1);
}
