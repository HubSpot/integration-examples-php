<?php

require_once __DIR__ . '/../../vendor/autoload.php';
$hubSpot = SevenShores\Hubspot\Factory::create($_ENV['HUBSPOT_API_KEY']);

$contactFields = array([
    'name' => 'email',
    'label' => 'Email',
    'value' => '',
]);

include '../views/contacts/show.php';