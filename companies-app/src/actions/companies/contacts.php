<?php

use Helpers\HubspotClientHelper;

$companyId = $_GET['companyId'] ?: null;

$hubSpot = HubspotClientHelper::createFactory();
const CONTACT_TO_COMPANY_DEFINITION_ID = 1;

if (isset($_POST['contactsIds'])) {
    $contactsIds = array_keys($_POST['contactsIds']);
    foreach ($contactsIds as $contactId) {
        $data = [
            'fromObjectId' => $contactId,
            'toObjectId' => $companyId,
            'category' => 'HUBSPOT_DEFINED',
            'definitionId' => CONTACT_TO_COMPANY_DEFINITION_ID,
        ];
        $redirectParams = [
            'id' => $companyId,
        ];
        if (isset($_POST['addToCompany'])) {
            // https://developers.hubspot.com/docs/methods/crm-associations/associate-objects
            $hubSpot->crmAssociations()->create($data);
            $redirectParams['contactsAdded'] = true;
        } else if (isset($_POST['deleteFromCompany'])) {
            // https://developers.hubspot.com/docs/methods/crm-associations/delete-association
            $hubSpot->crmAssociations()->delete($data);
            $redirectParams['contactsDeleted'] = true;
        }
    }
    header('Location: /companies/show.php?'.http_build_query($redirectParams));
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

