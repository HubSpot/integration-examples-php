<?php

include_once '../../Helpers/HubspotClientHelper.php';

$hubSpot = Helpers\HubspotClientHelper::createFactory();

// https://developers.hubspot.com/docs/methods/contacts/get_contacts
$response = $hubSpot->contacts()->all([
    'count' => 10,
]);
$contacts = $response['contacts'];

include '../../views/contacts/list.php';
