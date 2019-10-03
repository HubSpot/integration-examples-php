<?php

use Helpers\HubspotClientHelper;

$companyId = $_GET['companyId'] ?: null;

$hubSpot = HubspotClientHelper::createFactory();
const CONTACT_TO_COMPANY_DEFINITION_ID = 1;

if (isset($_POST['contactsIds'])) {
    $contactsIds = array_keys($_POST['contactsIds']);
    foreach ($contactsIds as $contactId) {
        // https://developers.hubspot.com/docs/methods/crm-associations/associate-objects
        $hubSpot->crmAssociations()->create([
            'fromObjectId' => $contactId,
            'toObjectId' => $companyId,
            'category' => 'HUBSPOT_DEFINED',
            'definitionId' => CONTACT_TO_COMPANY_DEFINITION_ID,
        ]);
    }
    header('Location: /companies/show.php?'.http_build_query([
        'id' => $companyId,
        'contactsAdded' => true,
    ]));
}

$search = $_GET['search'];
if (!empty($search)) {
    // https://developers.hubspot.com/docs/methods/contacts/search_contacts
    $contacts = $hubSpot->contacts()->search($search)->getData()->contacts;
} else {
    // https://developers.hubspot.com/docs/methods/companies/get-all-companies
    $contacts = $hubSpot->contacts()->all([])->getData()->contacts;
}

include __DIR__.'/../../views/companies/contacts.php';

