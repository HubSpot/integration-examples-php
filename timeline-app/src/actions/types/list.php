<?php
use Helpers\HubspotClientHelper;

$hubSpot = \SevenShores\Hubspot\Factory::create('73565ca9-e141-464b-a745-0857380bcc0c');
// https://developers.hubspot.com/docs/methods/timeline/get-event-types
$response = $hubSpot->timeline()->getEventTypes(getEnvOrException('HUBSPOT_APPLICATION_ID'));

if (!HubspotClientHelper::isResponseSuccessful($response)) {
   throw new Exception($response->getReasonPhrase());
}

$types = $response->getData();
include __DIR__ . '/../../views/types/list.php';
