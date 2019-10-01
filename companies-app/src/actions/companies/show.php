<?php

use Helpers\HubspotClientHelper;
use Helpers\CompanyPropertiesHelper;

$hubSpot = Helpers\HubspotClientHelper::createFactory();

function format_properties_for_request($keyValueProperties) {
    $properties = [];
    foreach ($keyValueProperties as $key => $value) {
        $properties[] = [
            'name' => $key,
            'value' => $value,
        ];
    }
    return $properties;
}

$companyProperties = [];
if (isset($_POST['name'])) {
    $companyProperties = $_POST;
    if (!isset($companyProperties['id'])) {
        $response = $hubSpot->companies()->create(format_properties_for_request($properties));
    } else {
        $id = $companyProperties['id'];
        unset($companyProperties['id']);
        // https://developers.hubspot.com/docs/methods/contacts/create_or_update
        $response = $hubSpot->companies()->update($id, format_properties_for_request($companyProperties));
    }

    if (HubspotClientHelper::isResponseSuccessful($response)) {
        header('Location: /companies/show.php?id=' . $response->getData()->companyId);
        exit();
    }

    $errorResponse = $response;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // https://developers.hubspot.com/docs/methods/contacts/get_contact
    $company = $hubSpot->companies()->getById($id)->getData();
    foreach ($company->properties as $key => $property) {
        $companyProperties[$key] = $property->value;
    }
}

// https://developers.hubspot.com/docs/methods/contacts/v2/get_contacts_properties
$properties = $hubSpot->companyProperties()->all()->getData();

$formFields = [];
foreach ($properties as $property) {
    $propertyName = $property->name;
    if (CompanyPropertiesHelper::isEditable($property)) {
        $formFields[] = [
            'name' => $property->name,
            'label' => $property->label,
            'value' => $companyProperties[$propertyName],
        ];
    }
}

include __DIR__.'/../../views/companies/show.php';
