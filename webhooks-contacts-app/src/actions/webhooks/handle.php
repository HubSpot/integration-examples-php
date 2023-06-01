<?php

use Helpers\KafkaHelper;
use SevenShores\Hubspot\Utils\Signature;

$requestBody = file_get_contents('php://input');

if (!Signature::isValid([
        'signature' => $_SERVER['HTTP_X_HUBSPOT_SIGNATURE'],
        'secret' => $_ENV['HUBSPOT_CLIENT_SECRET'],
        'requestBody' => $requestBody
    ])) {
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
