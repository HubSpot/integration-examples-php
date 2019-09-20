<?php

include_once '../../Helpers/HubspotClientHelper.php';

try {
    $hubSpot = Helpers\HubspotClientHelper::createFactory();
} catch (Throwable $t) {
    $message = $t->getMessage();
    include '../../views/message.php';
    exit();
}

// https://developers.hubspot.com/docs/methods/contacts/get_contacts
$response = $hubSpot->contacts()->all([
    'count' => 10,
]);
$contacts = $response['contacts'];

include '../../views/contacts/list.php';
