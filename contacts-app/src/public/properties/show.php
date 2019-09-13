<?php

require_once __DIR__ . '/../../../vendor/autoload.php';
$hubSpot = SevenShores\Hubspot\Factory::create($_ENV['HUBSPOT_API_KEY']);

if (isset($_POST['name'])) {
    $propertyFields = $_POST;
    $response = $hubSpot->contactProperties()->update($propertyFields['name'], $propertyFields);
    $vid = $response->data->vid;
    header('Location: /contacts/show.php?vid='.$vid);
}


$response = $hubSpot->contactProperties()->get($_GET['name']);
$property = $response->getData();

include '../../views/properties/show.php';
