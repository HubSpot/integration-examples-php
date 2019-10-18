<?php
require_once '/app/vendor/autoload.php';
use Helpers\KafkaHelper;
KafkaHelper::getConsumer([getEnvParam('EVENT_TOPIC', 'events')])
    ->start(function ($topic, $part, $message): void {
        $event = (array) json_decode($message['message']['value']);
        var_dump($event);
        \Repositories\EventsRepository::saveEvent($event);
    });
