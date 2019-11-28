<?php

use Helpers\Oauth2Helper;
use Repositories\EventTypesRepository;

include_once '../../vendor/autoload.php';

session_start();
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

try {
    \Helpers\DBClientHelper::runMigrations();

    $publicRoutes = require '../routes/public.php';
    $protectedRoutes = require '../routes/protected.php';

    if (!in_array($uri, $publicRoutes)) {
        if (!EventTypesRepository::getHubspotEventIDByCode('BotAdded')
                || !EventTypesRepository::getHubspotEventIDByCode('acceptedInvitation')) {
            header('Location: /events/init.php');
        } elseif (!Oauth2Helper::isAuthenticated()) {
            header('Location: /oauth/login.php');
        }
    }

    if ('/' === $uri) {
        header('Location: /telegram/link.php');
        exit();
    }

    if (!in_array($uri, array_merge($publicRoutes, $protectedRoutes))) {
        http_response_code(404);
        exit();
    }

    $path = __DIR__.'/../actions'.$uri;
    require $path;
} catch (Throwable $throwable) {
    $message = $throwable->getMessage();
    include __DIR__.'/../views/error.php';
    exit();
}
