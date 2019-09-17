<?php

include_once '../../Helpers/HubspotClientHelper.php';

$contacts = [];
$search = $_GET['search'];

if (isset($search)) {
    $hubSpot = Helpers\HubspotClientHelper::createFactory();

    $response = $hubSpot->contacts()->search($_GET['search']);
    $contacts = $response['contacts'];
}

include '../../views/contacts/list.php';
