<?php

use SevenShores\Hubspot\Utils\Webhooks;

$requestBody = file_get_contents('php://input');

//if (!Webhooks::isHubspotSignatureValid($_SERVER['HTTP_X_HUBSPOT_SIGNATURE'], $_ENV['HUBSPOT_CLIENT_SECRET'], $requestBody)) {
//    header("HTTP/1.1 401 Unauthorized");
//    exit();
//}

$events = json_decode($requestBody, true);

foreach ($events as $event) {
    if ($event['subscriptionType'] == 'contact.propertyChange' 
            && $event['subscriptionType'] == getEnvOrException('PROTECTED_PROPERTY')) {
        var_dump($event);
    }
}
