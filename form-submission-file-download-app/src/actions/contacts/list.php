<?php

use Helpers\HubspotClientHelper;

$hubSpot = HubspotClientHelper::createFactory();
$public = getEnvOrException('PUBLIC_PROPERTY');
$protected = getEnvOrException('PROTECTED_PROPERTY');

if (isset($_POST['search'])) {
    $contacts = $hubSpot->contacts()->search($_POST['search'], [
        'property' => [
            'email',
            $protected,
            $public
        ]
    ])->getData()->contacts;
} else {
    $contacts = $hubSpot->contacts()->recent([
        'property' => [
            'email',
            $protected,
            $public
        ]
    ])->getData()->contacts;
}

include __DIR__.'/../../views/contacts/list.php';
