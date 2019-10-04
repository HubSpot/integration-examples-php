<?php

use Helpers\HubspotClientHelper;

$hubSpot = HubspotClientHelper::createFactory();
const CONTACT_TO_COMPANY_DEFINITION_ID = 1;

function create_or_delete_contacts_associations($companyId, $contactsIds) {
    $hubSpot = HubspotClientHelper::createFactory();
    $redirectParams = [
        'id' => $companyId,
    ];
    foreach ($contactsIds as $contactId) {
        $data = [
            'fromObjectId' => $contactId,
            'toObjectId' => $companyId,
            'category' => 'HUBSPOT_DEFINED',
            'definitionId' => CONTACT_TO_COMPANY_DEFINITION_ID,
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
    $redirectUrl = '/companies/show.php?'.http_build_query($redirectParams);
    return $redirectUrl;
}

$companyId = $_GET['companyId'] ?: null;

if (isset($_POST['contactsIds'])) {
    $contactsIds = array_keys($_POST['contactsIds']);
    $redirectUrl = create_or_delete_contacts_associations($companyId, $contactsIds);
    header('Location: '.$redirectUrl);
    exit();
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

