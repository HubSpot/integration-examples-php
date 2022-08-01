<?php

use Helpers\ContactPropertiesHelper;
use Helpers\HubspotClientHelper;

$hubSpot = Helpers\HubspotClientHelper::createFactory();

$contactProperties = [];
if (isset($_POST['email'])) {
    $contactProperties = $_POST;
    $properties = [];
    foreach ($contactProperties as $key => $value) {
        $properties[] = [
            'property' => $key,
            'value' => $value,
        ];
    }
    // https://developers.hubspot.com/docs/methods/contacts/create_or_update
    $createOrUpdateResponse = $hubSpot->contacts()->createOrUpdate($contactProperties['email'], $properties);
    if (HubspotClientHelper::isResponseSuccessful($createOrUpdateResponse)) {
        $vid = $createOrUpdateResponse->getData()->vid;
        header('Location: /contacts/show?vid='.$vid.'&&updated=true');

        exit;
    }

    $errorResponse = $createOrUpdateResponse;
}

if (isset($_GET['vid'])) {
    $id = $_GET['vid'];
    // https://developers.hubspot.com/docs/methods/contacts/get_contact
    $contact = $hubSpot->contacts()->getById($id)->getData();
    foreach ($contact->properties as $key => $property) {
        $contactProperties[$key] = $property->value;
    }
    $contactId = $_GET['vid'];
    // https://developers.hubspot.com/docs/methods/crm-associations/get-associations
    $engagementIds = $hubSpot->crmAssociations()->get($contactId, $hubSpot->crmAssociations()::CONTACT_TO_ENGAGEMENT)->getData()->results;
    $engagements = [];
    foreach ($engagementIds as $engagementId) {
        $engagement = $hubSpot->engagements()->get($engagementId)->getData();
        if (!empty($engagement)) {
            $engagements[] = $engagement;
        }
    }
}

// https://developers.hubspot.com/docs/methods/contacts/v2/get_contacts_properties
$properties = $hubSpot->contactProperties()->all()->getData();
// https://developers.hubspot.com/docs/methods/owners/get_owners
$owners = $hubSpot->owners()->all()->getData();

$formFields = [];
foreach ($properties as $property) {
    $propertyName = $property->name;
    if (ContactPropertiesHelper::isEditable($property)) {
        $formFields[] = [
            'name' => $property->name,
            'label' => $property->label,
            'value' => $contactProperties[$propertyName] ?? '',
        ];
    }
}

include __DIR__.'/../../views/contacts/show.php';
