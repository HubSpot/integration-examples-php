<?php

require_once __DIR__ . '/../../../vendor/autoload.php';
$hubSpot = SevenShores\Hubspot\Factory::create($_ENV['HUBSPOT_API_KEY']);

$response = $hubSpot->contactProperties()->all();
$properties = $response->getData();

include '../../views/properties/list.php';
