<?php


namespace Helpers;

use SQLite3;

class DBClientHelper
{
    private static $dbClient = null;

    public static function getClient() {
        if (!self::$dbClient) {
            $db = new SQLite3(__DIR__.'/../../db/webhooks.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
            self::$dbClient = $db;
        }
        return self::$dbClient;
    }
}
