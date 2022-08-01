<?php

use Helpers\KafkaHelper;
use SevenShores\Hubspot\Utils\Webhooks;

$requestBody = file_get_contents('php://input');

if (!Webhooks::isHubspotSignatureValid($_SERVER['HTTP_X_HUBSPOT_SIGNATURE'], $_ENV['HUBSPOT_CLIENT_SECRET'], $requestBody)) {
    header('HTTP/1.1 401 Unauthorized');

    exit;
}

$events = json_decode($requestBody, true);

foreach ($events as $event) {
    KafkaHelper::getProducer()->send([
        [
            'topic' => getEnvParam('EVENT_TOPIC', 'events'),
            'value' => json_encode($event),
            'key' => '',
        ],
    ]);
}
