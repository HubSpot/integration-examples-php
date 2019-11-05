<?php


namespace Helpers;

use SevenShores\Hubspot\Http\Response;
use SevenShores\Hubspot\Factory;

class HubspotClientHelper
{
    const HTTP_OK = 200;

    const HTTP_EMPTY = 204;

    public static function createFactory() {
        $accessToken = Oauth2Helper::refreshAndGetAccessToken();

        $client = new Factory(
            [
                'key' => $accessToken,
                'oauth2' => true,
            ],
            null,
            [
                'http_errors' => true // pass any Guzzle related option to any request, e.g. throw no exceptions
            ],
            true
        );
        return $client;
    }

    public static function createFactoryForOauth() {
        $client = new Factory(
            [
                'key' => null,
                'oauth2' => false,
            ],
            null,
            [
                'http_errors' => true // pass any Guzzle related option to any request, e.g. throw no exceptions
            ],
            true
        );
        return $client;
    }

    public static function isResponseSuccessful(Response $response) {
        return $response->getStatusCode() === static::HTTP_OK;
    }

    public static function isEmptyResponseSuccessful(Response $response) {
        return $response->getStatusCode() === static::HTTP_EMPTY;
    }
}
