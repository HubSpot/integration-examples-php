<?php

use Helpers\Oauth2Helper;

$oauth2Client = Oauth2Helper::getHubspotOauth2Client();
$authUrl = $oauth2Client->getAuthorizationUrl();

header('Location: '.$authUrl);
