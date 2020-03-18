<?php

use Helpers\HubspotClientHelper;
use Helpers\OAuth2Helper;
use Repositories\TokensRepository;

$token = HubspotClientHelper::getOAuth2Resource()->getTokensByCode(
    OAuth2Helper::getClientId(),
    OAuth2Helper::getClientSecret(),
    OAuth2Helper::getRedirectUri(),
    $_GET['code']
)->toArray();

TokensRepository::save($token);

header('Location: /');
