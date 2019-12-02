<?php

use Helpers\HubspotClientHelper;
use Helpers\UrlHelper;

if (!isset($_POST['formName'])) {
    $formName = 'HubSpot PHP Sample Form Submission and File Download App '.uniqid();
    include __DIR__.'/../../views/forms/init.php';
    exit();
}

$hubSpot = HubspotClientHelper::createFactory();

foreach ([
    getEnvOrException('PROTECTED_FILE_LINK_PROPERTY'),
    getEnvOrException('PUBLIC_FILE_LINK_PROPERTY'),
] as $propetry) {
    //call to https://developers.hubspot.com/docs/methods/companies/get_contact_property
    $response = $hubSpot->contactProperties()->get($propetry);

    if (HubspotClientHelper::isResponseNotFound($response)) {
        // Create properties to store links to uploaded file if it doesn't exist yet
        // call to https://developers.hubspot.com/docs/methods/contacts/v2/create_contacts_property
        $propertyResponse = $hubSpot->contactProperties()->create([
            'name' => $propetry,
            'label' => $propetry,
            'description' => 'HubSpot PHP sample Form Submission and File Download app use this field for uploading picture',
            'groupName' => 'contactinformation',
            'type' => 'string',
            'formField' => true,
            'fieldType' => 'file',
        ]);
        $hubSpotProperty = $propertyResponse->getData();
    } else {
        $hubSpotProperty = $response->getData();
    }

    if ('file' !== $hubSpotProperty->fieldType) {
        throw  new Exception('Property '.$property.' already exists and it is not file');
    }
}

$formName = $_POST['formName'];
$propertyName = getEnvOrException('PROTECTED_FILE_LINK_PROPERTY');

// Create a form on the portal
// call to https://developers.hubspot.com/docs/methods/forms/v2/create_form
$formResponse = $hubSpot->forms()->create([
    'name' => $formName,
    'submitText' => 'Save',
    'redirect' => UrlHelper::generateServerUri().'/contacts/list.php',
    'formFieldGroups' => [
        [
            'fields' => [
                [
                    [
                        'name' => 'email',
                        'label' => 'Contacts Email',
                        'type' => 'string',
                        'fieldType' => 'text',
                        'required' => true,
                        'placeholder' => 'Email',
                    ],
                ],
            ],
            'default' => true,
            'isSmartGroup' => false,
        ],
        [
            'fields' => [
                [
                    [
                        'name' => $propertyName,
                        'label' => $propertyName,
                        'type' => 'string',
                        'fieldType' => 'file',
                        'placeholder' => $propertyName,
                    ],
                ],
            ],
            'default' => true,
            'isSmartGroup' => false,
        ],
    ],
]);

//var_dump($formResponse); die();

if (HubspotClientHelper::isResponseSuccessful($formResponse)) {
    $_SESSION['FORM'] = [
        'formId' => $formResponse->getData()->guid,
        'portalId' => $formResponse->getData()->portalId,
    ];
    header('Location: /forms/form.php');
} else {
    throw new Exception($formResponse->getReasonPhrase());
}
