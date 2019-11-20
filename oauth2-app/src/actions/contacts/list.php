<?php

use Helpers\HubspotClientHelper;
use Helpers\OAuth2Helper;

if (OAuth2Helper::isAuthenticated()) {
    $hubSpot = HubspotClientHelper::createFactory();

    // https://developers.hubspot.com/docs/methods/contacts/get_contacts
    $response = $hubSpot->contacts()->all([
        'count' => 10,
    ]);
    $contacts = $response['contacts'];

    include __DIR__.'/../../views/contacts/list.php';
} else {
    include __DIR__.'/../../views/oauth/login.php';
}
