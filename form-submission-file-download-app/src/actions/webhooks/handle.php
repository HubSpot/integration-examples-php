<?php

use GuzzleHttp\Psr7\StreamWrapper;
use Helpers\HubspotClientHelper;
use SevenShores\Hubspot\Utils\Webhooks;

$hubSpot = HubspotClientHelper::createFactory();

$requestBody = file_get_contents('php://input');

if (!Webhooks::isHubspotSignatureValid($_SERVER['HTTP_X_HUBSPOT_SIGNATURE'], getEnvOrException('HUBSPOT_CLIENT_SECRET'), $requestBody)) {
    header('HTTP/1.1 401 Unauthorized');
    exit();
}

$events = json_decode($requestBody, true);

$publicProperty = getEnvOrException('PUBLIC_FILE_LINK_PROPERTY');
$protectedProperty = getEnvOrException('PROTECTED_FILE_LINK_PROPERTY');

foreach ($events as $event) {
    // check if we got an event on property change corresponding to file submitted through our form
    if ('contact.propertyChange' == $event['subscriptionType']
            && $event['propertyName'] == $protectedProperty) {
        if (!empty($event['propertyValue'])) {
            //Get file from the form  https://developers.hubspot.com/docs/methods/form-integrations/v1/uploaded-files/signed-url-redirect
            $response = $hubSpot->forms()->getUploadedFileByUrl($event['propertyValue']);

            // Then upload this file via file maneger https://developers.hubspot.com/docs/methods/files/post_files
            if (HubspotClientHelper::isResponseSuccessful($response)) {
                $uploadResponse = $hubSpot->files()->upload(StreamWrapper::getResource($response->getBody()), ['file_names' => uniqid()]);

                if (HubspotClientHelper::isResponseSuccessful($uploadResponse)) {
                    // Update the property with Public link to the file
                    $hubSpot->contacts()->update(
                        $event['objectId'],
                        [
                            [
                                'property' => $publicProperty,
                                'value' => $uploadResponse->getData()->objects[0]->friendly_url,
                            ],
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
                        'value' => null,
                    ],
                ]
            );
        }
    }
}
