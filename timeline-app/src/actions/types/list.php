<?php
use Helpers\HubspotClientHelper;

$hubSpot = HubspotClientHelper::createFactory();
// https://developers.hubspot.com/docs/methods/timeline/get-event-types
$response = $hubSpot->timeline()->getEventTypes($_ENV['HUBSPOT_APPLICATION_ID']);

if (!HubspotClientHelper::isResponseSuccessful($response)) {
   throw new Exception($response->getReasonPhrase());
}

$types = $response->getData();
include __DIR__ . '/../../views/types/list.php';
