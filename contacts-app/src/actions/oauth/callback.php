<?php

use Helpers\Oauth2Helper;

$oauth2Client = Oauth2Helper::getHubspotOauth2Client();
$tokens = $oauth2Client->getTokens($_GET['code']);
Oauth2Helper::saveTokens($tokens);

header('Location: /');
