<?php

use Helpers\OAuth2Helper;
use \Helpers\HubspotClientHelper;

$tokens = HubspotClientHelper::getOAuth2Resource()->getTokensByCode(
    OAuth2Helper::getClientId(),
    OAuth2Helper::getClientSecret(),
    OAuth2Helper::getRedirectUri(),
    $_GET['code']
)->toArray();

OAuth2Helper::saveTokens($tokens);

header('Location: /');
