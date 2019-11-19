<?php

use SevenShores\Hubspot\Utils\Webhooks;
use Helpers\HubspotClientHelper;
use GuzzleHttp\Psr7\StreamWrapper;

$hubSpot = HubspotClientHelper::createFactory();

$requestBody = file_get_contents('php://input');

if (!Webhooks::isHubspotSignatureValid($_SERVER['HTTP_X_HUBSPOT_SIGNATURE'], getEnvOrException('HUBSPOT_CLIENT_SECRET'), $requestBody)) {
    header("HTTP/1.1 401 Unauthorized");
    exit();
}

$events = json_decode($requestBody, true);

$publicProperty = getEnvOrException('PUBLIC_PROPERTY');
$protectedProperty = getEnvOrException('PROTECTED_PROPERTY');

foreach ($events as $event) {
    if ($event['subscriptionType'] == 'contact.propertyChange' 
            && $event['propertyName'] == $protectedProperty) {
        
        if (!empty($event['propertyValue'])) {
            $response = $hubSpot->forms()->getUploadedFileByUrl($event['propertyValue']);
            
            if (HubspotClientHelper::isResponseSuccessful($response)) {
                $uploadResponse = $hubSpot->files()->upload(StreamWrapper::getResource($response->getBody()), ['file_names' => uniqid()]);
                
                if (HubspotClientHelper::isResponseSuccessful($uploadResponse)) {
                    $hubSpot->contacts()->update(
                            $event['objectId'],
                            [   
                                [
                                    'property' => $publicProperty,
                                    'value' => $uploadResponse->getData()->objects[0]->friendly_url
                                ]
                            ]
                        );
                    return $uploadResponse->getData()->objects[0]->friendly_url;
                }
            }
        } else {
            
            $hubSpot->contacts()->update(
                    $event['objectId'],
                    [   
                        [
                            'property' => $publicProperty,
                            'value' => null
                        ]
                    ]
                );
        }
    }
}
