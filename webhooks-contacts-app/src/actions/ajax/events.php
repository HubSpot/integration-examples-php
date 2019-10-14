<?php

use Repositories\EventsRepository;

$notShownEventsCount = EventsRepository::getNotShownEventsCount();

print json_encode([
    'notShownEventsCount' => $notShownEventsCount,
]);
