<?php


namespace Helpers;

use SevenShores\Hubspot\Factory;

class HubspotClientHelper
{
    public static function createFactory() {
        $accessToken = OAuth2Helper::refreshAndGetAccessToken();
        return self::create([
            'key' => $accessToken,
            'oauth2' => true,
        ]);
    }

    public static function getOAuth2Resource() {
        return self::create()->oAuth2();
    }

    protected static function create($factoryConfig = []) {
        return new Factory(
            $factoryConfig,
            null,
            [
                'http_errors' => false // pass any Guzzle related option to any request, e.g. throw no exceptions
            ],
            true
        );
    }
}
