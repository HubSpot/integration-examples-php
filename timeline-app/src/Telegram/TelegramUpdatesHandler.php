<?php

namespace Telegram;

use Longman\TelegramBot\Telegram;
use Repositories\TelegramUpdatesRepository;

class TelegramUpdatesHandler
{
    protected $telegram;
    const COMMANDS_PATHS = [
        __DIR__ . '/Commands',
    ];

    public function __construct(string $botApiKey, string $botUsername)
    {
        $this->telegram = new Telegram($botApiKey, $botUsername);
        $this->telegram->useGetUpdatesWithoutDatabase();
        $this->telegram->addCommandsPaths(self::COMMANDS_PATHS);
    }

    public function handle() : void {
        $maxUpdateId = TelegramUpdatesRepository::findMaxId();
        $updates = \Longman\TelegramBot\Request::getUpdates(['offset' => $maxUpdateId + 1])->getResult();
        foreach ($updates as $update) {
            TelegramUpdatesRepository::save(['id' => $update->update_id]);
            $this->telegram->processUpdate($update);
        }
    }
}
