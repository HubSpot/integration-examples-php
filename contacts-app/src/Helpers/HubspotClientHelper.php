<?php


namespace Helpers;

use SevenShores\Hubspot\Factory;

require_once __DIR__ . '/../../vendor/autoload.php';

class HubspotClientHelper
{
    public static function createFactory() {
        session_start();
        $useOauth = isset($_SESSION['accessToken']);
        $client = new Factory([
            'key' => $useOauth ? $_SESSION['accessToken'] : $_ENV['HUBSPOT_API_KEY'],
            'oauth2' => $useOauth,
        ]);
        return $client;
    }
}
