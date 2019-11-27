<?php

use Helpers\HubspotClientHelper;
use Repositories\EventTypesRepository;
use Repositories\InvitationsRepository;

$hubSpot = HubspotClientHelper::createFactory();
/*
$botAddedResponse = $hubSpot->timeline()->createOrUpdate(
        getEnvOrException('HUBSPOT_APPLICATION_ID'),
        EventTypesRepository::getHubspotEventIDByCode('BotAdded'),
        uniqid(),
        '8353'
    );

var_dump($botAddedResponse->getStatusCode(), $botAddedResponse->getReasonPhrase());

$key = uniqid();*/

$invitationResponse = $hubSpot->timeline()->createOrUpdate(
        getEnvOrException('HUBSPOT_APPLICATION_ID'),
        EventTypesRepository::getHubspotEventIDByCode('acceptedInvitation'),
        uniqid(),
        null,
        'tanas@smart-it.io',
        null,
        [],
        null,
        ['name' => InvitationsRepository::getById(1)['name']]
    );

var_dump($invitationResponse->getStatusCode(), $invitationResponse->getReasonPhrase());
   

//$response = $hubSpot->timeline()->getEvent(
//        getEnvOrException('HUBSPOT_APPLICATION_ID'),
//        EventTypesRepository::getHubspotEventIDByCode('acceptedInvitation'),
//        $key
//    );
//
//var_dump($response->getStatusCode(), $response->getReasonPhrase(), $response->getData());
