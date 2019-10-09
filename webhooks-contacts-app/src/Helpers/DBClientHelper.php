<?php


namespace Helpers;

use SQLite3;

class DBClientHelper
{
    private static $dbClient = null;

    public static function getClient() {
        if (!self::$dbClient) {
            $db = new SQLite3(__DIR__.'/../../db/webhooks.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
            $db->exec(
                "
create table if not exists events
(
    id INTEGER not null primary key autoincrement,
    event_type  VARCHAR,
    object_id   int      default null,
    event_id    int      default null,
    occurred_at datetime default null,
    created_at  datetime default (datetime('now', 'localtime'))
);
"
            );
            self::$dbClient = $db;
        }
        return self::$dbClient;
    }
}
