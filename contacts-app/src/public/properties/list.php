<?php

include_once '../../Helpers/HubspotClientHelper.php';

$hubSpot = Helpers\HubspotClientHelper::createFactory();

$response = $hubSpot->contactProperties()->all();
$properties = $response->getData();

include '../../views/properties/list.php';
