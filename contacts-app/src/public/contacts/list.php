<?php

require_once __DIR__ . '/../../../vendor/autoload.php';
$hubSpot = SevenShores\Hubspot\Factory::create($_ENV['HUBSPOT_API_KEY']);

$response = $hubSpot->contacts()->all([
    'count' => 10,
]);
$contacts = $response['contacts'];

include '../../views/contacts/list.php';
