<?php

use Helpers\UrlHelper;
use Oauth\HubspotOauth2Client;

include_once '../../Oauth/HubspotOauth2Client.php';
include_once '../../Helpers/UrlHelper.php';

$oauth2Client = new HubspotOauth2Client([
    'clientId' => $_ENV['HUBSPOT_CLIENT_ID'],
    'redirectUri' => UrlHelper::generateServerUri().'/oauth/callback.php',
    'scope' => HubspotOauth2Client::APP_REQUIRED_SCOPE,
]);

$authUrl = $oauth2Client->getAuthorizationUrl();

header('Location: '.$authUrl);
exit();