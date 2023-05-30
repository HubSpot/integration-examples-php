<?php

namespace Helpers;

use PDO;
use ByJG\Util\Uri;
use ByJG\DbMigration\Migration;
use ByJG\DbMigration\Database\MySqlDatabase;

class DBClientHelper
{
    private static $dbClient;

    public static function getClient()
    {
        if (!self::$dbClient) {
            $pdo = new PDO('mysql:host='.$_ENV['DB_HOST'].';dbname='.$_ENV['DB_NAME'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            self::$dbClient = $pdo;
        }

        return self::$dbClient;
    }

    public static function runMigrations()
    {
        $uri = 'mysql://'.$_ENV['DB_USERNAME'].':'.$_ENV['DB_PASSWORD'].'@'.$_ENV['DB_HOST'].'/'.$_ENV['DB_NAME'];
        $connectionUri = new Uri($uri);
        Migration::registerDatabase(MySqlDatabase::class);
        $migration = new Migration($connectionUri, __DIR__.'/../../sql');

        try {
            $migration->getCurrentVersion();
        } catch (\Throwable $t) {
            $migration->reset();
        }
        $migration->update($version = null);
    }
}
