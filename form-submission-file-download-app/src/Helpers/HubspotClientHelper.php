<?php

namespace Helpers;

use SevenShores\Hubspot\Factory;
use SevenShores\Hubspot\Http\Response;

class HubspotClientHelper
{
    const HTTP_OK = 200;
    const HTTP_OK_EMPTY = 204;
    const HTTP_NOT_FOUND = 404;

    public static function createFactory(): Factory
    {
        if (empty($_ENV['HUBSPOT_API_KEY'])) {
            throw new \Exception('Please specify API key');
        }

        return static::create([
            'key' => $_ENV['HUBSPOT_API_KEY'],
            'oauth2' => false,
        ]);
    }

    public static function isResponseSuccessful(Response $response): bool
    {
        return $response->getStatusCode() === static::HTTP_OK;
    }

    public static function isResponseSuccessfulButEmpty(Response $response): bool
    {
        return $response->getStatusCode() === static::HTTP_OK_EMPTY;
    }

    public static function isResponseNotFound(Response $response): bool
    {
        return $response->getStatusCode() === static::HTTP_NOT_FOUND;
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
