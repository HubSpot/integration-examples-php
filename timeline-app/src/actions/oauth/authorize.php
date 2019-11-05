<?php

use Helpers\Oauth2Helper;

$oauth2Client = Oauth2Helper::getHubspotOauth2Client();

header('Location: '.$oauth2Client->getAuthorizationUrl());
