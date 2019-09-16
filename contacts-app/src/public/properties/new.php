<?php

include_once '../../Helpers/HubspotClientHelper.php';

$hubSpot = Helpers\HubspotClientHelper::createFactory();

if (isset($_POST['name'])) {
    $propertyFields = $_POST;
    $response = $hubSpot->contactProperties()->create($propertyFields);
    $name = $response->data->name;
    header('Location: /properties/show.php?name='.$name);
}

$property = (object)[
    'type' => 'string',
];

include '../../views/properties/show.php';
