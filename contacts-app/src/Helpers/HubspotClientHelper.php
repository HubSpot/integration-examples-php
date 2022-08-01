<?php

namespace Helpers;

use SevenShores\Hubspot\Factory;
use SevenShores\Hubspot\Http\Response;
use SevenShores\Hubspot\Resources\OAuth2;

class HubspotClientHelper
{
    public const HTTP_OK = 200;
    public const HTTP_OK_EMPTY = 204;

    public static function createFactory(): Factory
    {
        $useOauth = OAuth2Helper::isAuthenticated();
        $token = $useOauth ? OAuth2Helper::refreshAndGetAccessToken() : $_ENV['HUBSPOT_ACCESS_TOKEN'];
        if (empty($token)) {
            throw new \Exception('Please specify access token or authorize via OAuth');
        }

        return static::create($token);
    }

    public static function getOAuth2Resource(): OAuth2
    {
        return static::create()->oAuth2();
    }

    public static function isResponseSuccessful(Response $response): bool
    {
        return $response->getStatusCode() === static::HTTP_OK;
    }

    public static function isResponseSuccessfulButEmpty(Response $response): bool
    {
        return $response->getStatusCode() === static::HTTP_OK_EMPTY;
    }

    protected static function create(string $token): Factory
    {
        return Factory::createWithOAuth2Token(
            $token,
            null,
            [
                'http_errors' => false, // pass any Guzzle related option to any request, e.g. throw no exceptions
            ],
            true
        );
    }
}
