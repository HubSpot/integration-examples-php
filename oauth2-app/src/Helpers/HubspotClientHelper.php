<?php


namespace Helpers;

use SevenShores\Hubspot\Factory;

class HubspotClientHelper
{
    public static function createFactory($requireAuth = true) {
        $factoryConfig = [];
        if ($requireAuth) {
            $accessToken = OAuth2Helper::refreshAndGetAccessToken();
            $factoryConfig['key'] = $accessToken;
            $factoryConfig['oauth2'] = true;
        }
        $client = new Factory(
            $factoryConfig,
            null,
            [
                'http_errors' => false // pass any Guzzle related option to any request, e.g. throw no exceptions
            ],
            true
        );

        return $client;
    }
}
