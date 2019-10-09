<?php

use Repositories\EventsRepository;
use Helpers\HubspotClientHelper;

$hubSpot = HubspotClientHelper::createFactory();

$contactsIds = EventsRepository::findLastModifiedObjectsIds();

$contacts = [];
foreach ($contactsIds as $contactsId) {
    $contact = [
        'id' => $contactsId,
        'events' => EventsRepository::findEventTypesByObjectId($contactsId),
    ];
    $response = $hubSpot->contacts()->getById($contactsId);
    if (HubspotClientHelper::isResponseSuccessful($response)) {
        $contact['properties'] = $response->getData()->properties;
    }
    $contacts[] = $contact;
}

include __DIR__.'/../../views/webhooks/events.php';
