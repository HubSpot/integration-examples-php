<?php

require_once __DIR__ . '/../../../vendor/autoload.php';
$hubSpot = SevenShores\Hubspot\Factory::create($_ENV['HUBSPOT_API_KEY']);

if (isset($_POST['name'])) {
    $propertyFields = $_POST;
/*    $properties = [];
    foreach ($propertyFields as $key => $value) {
        $properties[] = [
            'property' => $key,
            'value' => $value,
        ];
    }*/

//    print_r($propertyFields); die();
    $response = $hubSpot->contactProperties()->update($propertyFields['name'], $propertyFields);
    print_r($response); die();

    $vid = $response->data->vid;
    header('Location: /contacts/show.php?vid='.$vid);
}


$response = $hubSpot->contactProperties()->get($_GET['name']);
$property = $response->getData();

include '../../views/properties/show.php';