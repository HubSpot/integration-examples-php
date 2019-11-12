<?php

namespace Helpers;

use SevenShores\Hubspot\Factory;
use SevenShores\Hubspot\Resources\OAuth2;
use SevenShores\Hubspot\Http\Response;

class HubspotClientHelper
{
    const HTTP_OK = 200;

    public static function createFactory(): Factory
    {
        $accessToken = OAuth2Helper::refreshAndGetAccessToken();
        return self::create([
            'key' => $accessToken,
            'oauth2' => true,
        ]);
    }

    public static function getOAuth2Resource(): OAuth2
    {
        return self::create()->oAuth2();
    }

    protected static function create($factoryConfig = []): Factory
    {
        return new Factory(
            $factoryConfig,
            null,
            [
                'http_errors' => false // pass any Guzzle related option to any request, e.g. throw no exceptions
            ],
            true
        );
    }

    public static function isResponseSuccessful(Response $response): bool
    {
        return $response->getStatusCode() === self::HTTP_OK;
    }
}
