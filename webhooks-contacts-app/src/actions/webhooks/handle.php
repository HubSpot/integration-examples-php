<?php

use Helpers\DBClientHelper;

$db = DBClientHelper::getClient();

$requestBody = file_get_contents('php://input');

$events = json_decode($requestBody, true);

foreach ($events as $event) {
    \Repositories\EventsRepository::saveEvent($event);
}
