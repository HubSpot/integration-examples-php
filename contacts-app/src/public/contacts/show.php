<?php

use Helpers\ContactPropertiesHelper;

require_once __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/../../Helpers/ContactPropertiesHelper.php';
$hubSpot = SevenShores\Hubspot\Factory::create($_ENV['HUBSPOT_API_KEY']);

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
if (isset($_GET['vid'])) {
    $id = $_GET['vid'];
    $contact = $hubSpot->contacts()->getById($id)->getData();
    $properties = $hubSpot->contactProperties()->all()->getData();
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
