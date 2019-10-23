<?php


namespace Helpers;

use PDO;

class DBClientHelper
{
    private static $dbClient = null;

    public static function getClient() {
        if (!self::$dbClient) {
            $pdo = new PDO('mysql:host=db;dbname=events', 'events', 'events');
            self::$dbClient = $pdo;
        }
        return self::$dbClient;
    }
}
