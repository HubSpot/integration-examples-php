<?php

namespace Helpers;

use SevenShores\Hubspot\Factory;
use SevenShores\Hubspot\Resources\OAuth2;
use SevenShores\Hubspot\Http\Response;

class HubspotClientHelper
{
    const HTTP_OK = 200;
    const HTTP_OK_EMPTY = 204;

    public static function createFactory(): Factory
    {
        $useOauth = OAuth2Helper::isAuthenticated();
        $key = $useOauth ? Oauth2Helper::refreshAndGetAccessToken() : $_ENV['HUBSPOT_API_KEY'];
        if (empty($key)) {
            throw new \Exception("Please specify API key or authorize via OAuth");
        }
        return static::create([
            'key' => $key,
            'oauth2' => $useOauth,
        ]);
    }

    public static function getOAuth2Resource(): OAuth2
    {
        return static::create()->oAuth2();
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
        return $response->getStatusCode() === static::HTTP_OK;
    }

    public static function isResponseSuccessfulButEmpty(Response $response): bool
    {
        return $response->getStatusCode() === static::HTTP_OK_EMPTY;
    }
}
