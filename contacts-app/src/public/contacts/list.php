<?php

include_once '../../Helpers/HubspotClientHelper.php';

$hubSpot = Helpers\HubspotClientHelper::createFactory();

$response = $hubSpot->contacts()->all([
    'count' => 10,
]);
$contacts = $response['contacts'];

include '../../views/contacts/list.php';
