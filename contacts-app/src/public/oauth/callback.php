<?php

use Helpers\UrlHelper;
use Oauth\HubspotOauth2Client;

include_once '../../Oauth/HubspotOauth2Client.php';
include_once '../../Helpers/UrlHelper.php';

session_start();

$oauth2Client = new HubspotOauth2Client([
    'clientId' => $_ENV['HUBSPOT_CLIENT_ID'],
    'clientSecret' => $_ENV['HUBSPOT_CLIENT_SECRET'],
    'redirectUri' => UrlHelper::generateServerUri().'/oauth/callback.php',
    'scope' => HubspotOauth2Client::APP_REQUIRED_SCOPE,
]);

$accessToken = $oauth2Client->getAccessToken($_GET['code']);

$_SESSION['accessToken'] = $accessToken;

header('Location: /');
exit();