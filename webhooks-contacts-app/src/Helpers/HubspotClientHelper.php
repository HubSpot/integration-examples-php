<?php

namespace Helpers;

use SevenShores\Hubspot\Factory;
use SevenShores\Hubspot\Http\Response;
use SevenShores\Hubspot\Endpoints\OAuth2;

class HubspotClientHelper
{
    public const HTTP_OK = 200;

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

    public static function isResponseSuccessful(Response $response): bool
    {
        return self::HTTP_OK === $response->getStatusCode();
    }

    protected static function create($factoryConfig = []): Factory
    {
        return new Factory(
            $factoryConfig,
            null,
            [
                'http_errors' => false, // pass any Guzzle related option to any request, e.g. throw no exceptions
            ],
            true
        );
    }
}
