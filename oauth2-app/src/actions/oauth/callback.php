<?php

use Helpers\OAuth2Helper;

$tokens = \Helpers\HubspotClientHelper::createFactory(false)->oAuth2()->getTokensByCode(
    OAuth2Helper::getClientId(),
    OAuth2Helper::getClientSecret(),
    OAuth2Helper::getRedirectUri(),
    $_GET['code']
)->toArray();

OAuth2Helper::saveTokens($tokens);

header('Location: /');
