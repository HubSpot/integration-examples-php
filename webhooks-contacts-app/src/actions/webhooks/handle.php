<?php

use Helpers\DBClientHelper;
use Repositories\EventsRepository;

function verify_hubspot_signature() {
    $requestSignature = $_SERVER['HTTP_X_HUBSPOT_SIGNATURE'];
    $requestBody = file_get_contents('php://input');
    $clientSecret = $_ENV['HUBSPOT_CLIENT_SECRET'];
    $requiredSignature = hash('sha256', $clientSecret.$requestBody);
    if ($requestSignature !== $requiredSignature) {
        header("HTTP/1.1 401 Unauthorized");
        exit();
    }
}

$requestBody = file_get_contents('php://input');;
verify_hubspot_signature();

$db = DBClientHelper::getClient();
$events = json_decode($requestBody, true);

foreach ($events as $event) {
    EventsRepository::saveEvent($event);
}
