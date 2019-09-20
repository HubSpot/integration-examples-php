<?php

use Helpers\UrlHelper;
use Oauth\HubspotOauth2Client;

$oauth2Client = new HubspotOauth2Client([
    'clientId' => $_ENV['HUBSPOT_CLIENT_ID'],
    'redirectUri' => UrlHelper::generateServerUri().'/oauth/callback.php',
    'scope' => HubspotOauth2Client::APP_REQUIRED_SCOPE,
]);

$authUrl = $oauth2Client->getAuthorizationUrl();

header('Location: '.$authUrl);
exit();