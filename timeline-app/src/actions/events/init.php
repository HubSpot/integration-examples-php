<?php

use Enums\EventTypeCode;
use Helpers\HubspotClientHelper;
use Repositories\EventTypesRepository;

if ('POST' !== $_SERVER['REQUEST_METHOD']) {
    include __DIR__.'/../../views/events/init.php';
    exit();
}

$hubSpot = HubspotClientHelper::createFactoryWithDeveloperAPIKey();
if (!EventTypesRepository::getHubspotEventIDByCode(EventTypeCode::BOT_ADDED)) {
    $botAdded = $hubSpot->timeline()->createEventType(
        getEnvOrException('HUBSPOT_APPLICATION_ID'),
        'Telegram Bot added',
        '# Telegram Bot added',
        'This event happened on {{#formatDate timestamp}}{{/formatDate}}',
        'CONTACT'
    );

    if (HubspotClientHelper::isResponseSuccessful($botAdded)) {
        EventTypesRepository::insert([
            'code' => EventTypeCode::BOT_ADDED,
            'hubspot_event_type_id' => $botAdded->getData()->id,
        ]);
    }
}

if (!EventTypesRepository::getHubspotEventIDByCode(EventTypeCode::USER_INVITATION_ACTION)) {
    $invitation = $hubSpot->timeline()->createEventType(
        getEnvOrException('HUBSPOT_APPLICATION_ID'),
        'User received/accepted/rejected an invitation',
        '#User {{ action }} an invitation for {{ name }}',
        'This event happened on {{#formatDate timestamp}}{{/formatDate}}',
        'CONTACT'
    );

    if (HubspotClientHelper::isResponseSuccessful($invitation)) {
        $nameProperty = $hubSpot->timeline()->createEventTypeProperty(
            getEnvOrException('HUBSPOT_APPLICATION_ID'),
            $invitation->getData()->id,
            'name',
            'Invitation Name',
            'String'
        );
        $actionProperty = $hubSpot->timeline()->createEventTypeProperty(
            getEnvOrException('HUBSPOT_APPLICATION_ID'),
            $invitation->getData()->id,
            'action',
            'User Action',
            'String'
        );

        if (HubspotClientHelper::isResponseSuccessful($nameProperty)
            && HubspotClientHelper::isResponseSuccessful($actionProperty)) {
            EventTypesRepository::insert([
                'code' => EventTypeCode::USER_INVITATION_ACTION,
                'hubspot_event_type_id' => $invitation->getData()->id,
            ]);
        }
    }
}

header('Location: /');
