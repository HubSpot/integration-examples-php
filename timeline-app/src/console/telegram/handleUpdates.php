<?php

/**
 * sample integration with telegram sdk
 * execute with "docker-compose exec web php src/console/telegram/botUpdates.php"
 */

require __DIR__.'/../../../vendor/autoload.php';

use Telegram\Bot\Api;

$telegram = new Api(getEnvOrException('TELEGRAM_BOT_API_KEY'));

$maxUpdateId = Repositories\TelegramUpdatesRepository::findMaxId();
$updates = $telegram->getUpdates(['offset' => $maxUpdateId + 1]);

foreach ($updates as $update) {
    \Repositories\TelegramUpdatesRepository::save(['id' => $update->update_id]);

    // send the same message back
    $telegram->sendMessage([
        'chat_id' => $update->getMessage()->chat->id,
        'text' => $update->getMessage()->text,
    ]);
}
