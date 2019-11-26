<?php


namespace Helpers;

use SevenShores\Hubspot\Http\Response;
use SevenShores\Hubspot\Factory;
use SevenShores\Hubspot\Resources\OAuth2;

class HubspotClientHelper
{
    const HTTP_OK = 200;

    const HTTP_EMPTY = 204;

    public static function createFactory() : Factory
    {
        $accessToken = OAuth2Helper::refreshAndGetAccessToken();
        return self::create([
            'key' => $accessToken,
            'oauth2' => true,
        ]);
    }

    public static function getOAuth2Resource() : OAuth2
    {
        return self::create()->oAuth2();
    }

    public static function createFactoryWithDeveloperAPIKey() : Factory
    {
        return static::create([
            'key' => getEnvOrException('HUBSPOT_DEVELOPER_API_KEY'),
            'oauth2' => false,
        ]);
    }

    protected static function create(array $factoryConfig = []) : Factory
    {
        return new Factory(
            $factoryConfig,
            null,
            [
                'http_errors' => true // pass any Guzzle related option to any request, e.g. throw no exceptions
            ],
            true
        );
    }

    public static function isResponseSuccessful(Response $response) : bool
    {
        return $response->getStatusCode() === static::HTTP_OK;
    }

    public static function isEmptyResponseSuccessful(Response $response) : bool
    {
        return $response->getStatusCode() === static::HTTP_EMPTY;
    }
}
