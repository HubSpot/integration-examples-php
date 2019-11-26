<?php
use Helpers\HubspotClientHelper;
use Repositories\EventTypesRepository;

$hubSpot = HubspotClientHelper::createFactoryWithDeveloperAPIKey();
if (!EventTypesRepository::getHubspotEventIDByCode('BotAdded')) {
    $botAdded = $hubSpot->timeline()->createEventType(
        getEnvOrException('HUBSPOT_APPLICATION_ID'),
        'Telegram Bot added',
        '# Telegram Bot added',
        'This event happened on {{#formatDate timestamp}}{{/formatDate}}',
        'CONTACT'
    );

    if (HubspotClientHelper::isResponseSuccessful($botAdded)) {
        EventTypesRepository::insert([
            'code' => 'BotAdded',
            'hubspot_event_type_id' => $botAdded->getData()->id,
        ]);
    }
}

if (!EventTypesRepository::getHubspotEventIDByCode('acceptedInvitation')) {
    $invitation = $hubSpot->timeline()->createEventType(
        getEnvOrException('HUBSPOT_APPLICATION_ID'),
        'User accepted an invitation',
        '#User accepted to visit {{ name }}',
        'This event happened on {{#formatDate timestamp}}{{/formatDate}}',
        'CONTACT'
    );
    
    if (HubspotClientHelper::isResponseSuccessful($invitation)) {
       $property = $hubSpot->timeline()->createEventTypeProperty(
            getEnvOrException('HUBSPOT_APPLICATION_ID'),
            $invitation->getData()->id,
            'name',
            'Invitation Name',
            'String'
        );
        
        if (HubspotClientHelper::isResponseSuccessful($property)) {
            EventTypesRepository::insert([
                'code' => 'AcceptedInvitation',
                'hubspot_event_type_id' => $invitation->getData()->id,
            ]);
        }
    }
}

header('Location: /oauth/login.php');
