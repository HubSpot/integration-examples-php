<?php

/**
 * sample integration with telegram sdk
 */

require __DIR__.'/../../../vendor/autoload.php';

use Telegram\Bot\Api;

function check_updates() : void {
    $maxUpdateId = Repositories\TelegramUpdatesRepository::findMaxId();

    $telegram = new Api(getEnvOrException('TELEGRAM_BOT_API_KEY'));
    $updates = $telegram->getUpdates(['offset' => $maxUpdateId + 1]);

    foreach ($updates as $update) {
        \Repositories\TelegramUpdatesRepository::save(['id' => $update->update_id]);

        // send the same message back
        $telegram->sendMessage([
            'chat_id' => $update->getMessage()->chat->id,
            'text' => 'Will you go to SAMPLE EVENT?',
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    [
                        ['text' => 'YES', 'callback_data' => 1],
                        ['text' => 'NO', 'callback_data' => 0],
                    ]
                ]
            ]),
        ]);
    }
}

while (true) {
    check_updates();
    sleep(1);
}
