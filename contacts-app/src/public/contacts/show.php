<?php

use Helpers\ContactPropertiesHelper;

require_once '../../Helpers/ContactPropertiesHelper.php';
include_once '../../Helpers/HubspotClientHelper.php';

$hubSpot = Helpers\HubspotClientHelper::createFactory();

if (isset($_POST['email'])) {
    $contactFields = $_POST;
    $properties = [];
    foreach ($contactFields as $key => $value) {
        $properties[] = [
            'property' => $key,
            'value' => $value,
        ];
    }
    $response = $hubSpot->contacts()->createOrUpdate($contactFields['email'], $properties);
    $vid = $response->data->vid;
    header('Location: /contacts/show.php?vid='.$vid);
}

$contactFields = [];
$owners = [];
if (isset($_GET['vid'])) {
    $id = $_GET['vid'];
    // request contact data
    $response = $hubSpot->contacts()->getById($id);
    $contact = $response->data;

    // request available properties
    $response = $hubSpot->contactProperties()->all();
    $properties = $response->getData();

    $response = $hubSpot->owners()->all();
    $owners = $response->getData();

    foreach ($properties as $property) {
        $propertyName = $property->name;
        if (ContactPropertiesHelper::isEditable($property)) {
            $contactFields[] = [
                'name' => $property->name,
                'label' => $property->label,
                'value' => $contact->properties->$propertyName->value,
            ];
        }
    }
}

include '../../views/contacts/show.php';
