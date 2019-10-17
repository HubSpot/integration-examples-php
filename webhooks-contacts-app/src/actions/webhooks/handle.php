<?php

use Helpers\KafkaHelper;

$requestBody = file_get_contents('php://input');

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
