<?php


namespace Helpers;

require_once __DIR__ . '/../../vendor/autoload.php';

class HubspotClientHelper
{
    public static function createFactory() {
        return \SevenShores\Hubspot\Factory::create($_ENV['HUBSPOT_API_KEY']);
    }
}
