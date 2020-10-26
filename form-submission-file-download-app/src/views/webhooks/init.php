<?php
/**
 * @var string
 */
include __DIR__.'/../_partials/header.php'; ?>
<div class="row">
    <div class="column column-15"></div>
    <div class="column column-70">
<pre>
// src/actions/webhooks/init.php - form and properties initialization script
$webhooksClient = HubspotClientHelper::createFactoryWithDeveloperAPIKey()
    ->webhooks();

set your url for receiving webhooks
$webhooksClient->updateSettings($appId, ['webhookUrl' => 'url']);

create a subscription
$webhooksClient->createSubscription($appId, [
    'subscriptionDetails' => [
        'subscriptionType' => 'contact.propertyChange',
        'propertyName' => 'propertyName',
    ],
    'enabled' => true,
]);
</pre>
        <form method="post" class="text-center">
            <h3>Initialization Webhooks Script - press Go button to initialize Webhooks</h3>
            <div class="text-center">
                <p>This script creates webhook.</p>
                <button type="submit">Go</button>
            </div>
        </form>
    </div>
    <div class="column column-15"></div>
</div>
<?php include __DIR__.'/../_partials/footer.php'; ?>
