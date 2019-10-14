<?php

use Repositories\EventsRepository;
use Helpers\HubspotClientHelper;

$hubSpot = HubspotClientHelper::createFactory();

$contactsIds = EventsRepository::findLastModifiedObjectsIds();

function format_event($eventName) {
    // "contact.creation" => "creation"
    $parts = explode('.', $eventName);
    return $parts[1];
}

$contacts = [];
foreach ($contactsIds as $contactsId) {
    $contact = [
        'id' => $contactsId,
        'events' => array_map('format_event', EventsRepository::findEventTypesByObjectId($contactsId)),
    ];
    $response = $hubSpot->contacts()->getById($contactsId);
    if (HubspotClientHelper::isResponseSuccessful($response)) {
        $contact['properties'] = $response->getData()->properties;
    }
    $contacts[] = $contact;
}

EventsRepository::markAllEventsAsShown();

include __DIR__.'/../../views/webhooks/events.php';
