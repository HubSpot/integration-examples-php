<?php


namespace Helpers;

use SevenShores\Hubspot\Factory;

class HubspotClientHelper
{
    public static function createFactory() {
        $accessToken = Oauth2Helper::refreshAndGetAccessToken();
        $client = new Factory(
            [
                'key' => $accessToken,
                'oauth2' => true,
            ],
            null,
            [
                'http_errors' => false // pass any Guzzle related option to any request, e.g. throw no exceptions
            ],
            true
        );
        return $client;
    }
}
