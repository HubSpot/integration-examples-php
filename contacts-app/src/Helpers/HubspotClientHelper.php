<?php


namespace Helpers;

use SevenShores\Hubspot\Factory;
use SevenShores\Hubspot\Http\Response;

require_once __DIR__ . '/../../vendor/autoload.php';

class HubspotClientHelper
{
    const HTTP_OK = 200;

    public static function createFactory() {
        session_start();
        $useOauth = isset($_SESSION['accessToken']);
        $key = $useOauth ? $_SESSION['accessToken'] : $_ENV['HUBSPOT_API_KEY'];
        if (empty($key)) {
            throw new \Exception("Please specify api key or authorize via oauth");
        }
        $client = new Factory(
            [
                'key' => $key,
                'oauth2' => $useOauth,
            ],
            null,
            [
                'http_errors' => false // pass any Guzzle related option to any request, e.g. throw no exceptions
            ],
            true,
        );
        return $client;
    }

    public static function isResponseSuccessful(Response $response) {
        return $response->getStatusCode() === self::HTTP_OK;
    }
}
