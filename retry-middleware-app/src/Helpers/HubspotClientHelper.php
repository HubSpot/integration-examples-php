<?php

namespace Helpers;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use SevenShores\Hubspot\Http\Client;
use SevenShores\Hubspot\Delay;
use SevenShores\Hubspot\Factory;
use SevenShores\Hubspot\Http\Response;
use SevenShores\Hubspot\Resources\OAuth2;
use SevenShores\Hubspot\RetryMiddlewareFactory;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class HubspotClientHelper
{
    const HTTP_OK = 200;

    public static function createFactory(): Factory
    {
        $accessToken = OAuth2Helper::refreshAndGetAccessToken();
        
        $config = [
            'key' => $accessToken,
            'oauth2' => true,
        ];

        return self::create($config, new Client($config, static::getGuzzleClient()));
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
    
    /**
     * This function creates GuzzleClient and suts up Retries Middlewares in it.
     */
    public static function getGuzzleClient(): GuzzleClient
    {
        $handlerStack = HandlerStack::create();
        $handlerStack->push(
            RetryMiddlewareFactory::createRateLimitMiddleware(
                Delay::getConstantDelayFunction()
            )
        );

        $handlerStack->push(
            RetryMiddlewareFactory::createInternalErrorsMiddleware(
                Delay::getExponentialDelayFunction(2)
            )
        );

        $logger = new Logger('log');
        $logger->pushHandler(new StreamHandler('php://stdout'));

        $handlerStack->push(
            Middleware::log(
                $logger,
                new MessageFormatter(MessageFormatter::SHORT)
            )
        );

        return new GuzzleClient(['handler' => $handlerStack]);
    }
}
