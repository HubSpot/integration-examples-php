<?php


namespace Helpers;

use SevenShores\Hubspot\Http\Response;

require_once __DIR__ . '/../../vendor/autoload.php';

class HubspotClientHelper
{
    const HTTP_OK = 200;

    public static function createFactory() {
        return \SevenShores\Hubspot\Factory::create(
            $_ENV['HUBSPOT_API_KEY'],
            null,
            [
                'http_errors' => false // pass any Guzzle related option to any request, e.g. throw no exceptions
            ],
            true
        );
    }

    public static function isSuccessfulResponse(Response $response) {
        return $response->getStatusCode() === self::HTTP_OK;
    }

    public static function createErrorObject(Response $response) {
        $error = $response->getData() ?: (object)[];
        $error->statusCode = $response->getStatusCode();
        return $error;
    }
}
