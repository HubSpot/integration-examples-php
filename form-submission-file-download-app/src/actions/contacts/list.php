<?php

use Helpers\HubspotClientHelper;

$hubSpot = HubspotClientHelper::createFactory();
$public = getEnvOrException('PUBLIC_FILE_LINK_PROPERTY');
$protected = getEnvOrException('PROTECTED_FILE_LINK_PROPERTY');
$search = null;

if (isset($_GET['search'])) {
    $contacts = $hubSpot->contacts()->search($_GET['search'], [
        'property' => [
            'email',
            $protected,
            $public,
        ],
    ])->getData()->contacts;
    
    $search = $_GET['search'];
} else {
    $contacts = $hubSpot->contacts()->recent([
        'property' => [
            'email',
            $protected,
            $public,
        ],
    ])->getData()->contacts;
}

include __DIR__.'/../../views/contacts/list.php';
