<?php

use Helpers\HubspotClientHelper;
use Helpers\UrlHelper;

if ('POST' !== $_SERVER['REQUEST_METHOD']) {
    include __DIR__.'/../../views/webhooks/init.php';
    exit();
}

$webhooksClient = HubspotClientHelper::createFactoryWithDeveloperAPIKey()
    ->webhooks()
;

$appId = getEnvOrException('HUBSPOT_APPLICATION_ID');

$response = $webhooksClient->getSubscription($appId);

$propertyName = getEnvOrException('PROTECTED_FILE_LINK_PROPERTY');
$propertyId = null;
$subscriptions = $response->getData();

foreach ($subscriptions as $subscription) {
    if ($subscription->subscriptionDetails->propertyName == $propertyName) {
        $propertyId = $subscription->id;
    }
    if ($subscription->enabled) {
        $webhooksClient->updateSubscription(
            $appId,
            $subscription->id,
            ['enabled' => false]
        );
    }
}
UrlHelper::generateServerUri().'/webhooks/handle.php';

$respons = $webhooksClient->updateSettings($appId, ['webhookUrl' => UrlHelper::generateServerUri().'/webhooks/handle.php']);

if (empty($propertyId)) {
    $webhooksClient->createSubscription($appId, [
        'subscriptionDetails' => [
            'subscriptionType' => 'contact.propertyChange',
            'propertyName' => getEnvOrException('PROTECTED_FILE_LINK_PROPERTY'),
        ],
        'enabled' => true,
    ]);
} else {
    $webhooksClient->updateSubscription($appId, $propertyId, ['enabled' => true]);
}

header('Location: /forms/form.php');
