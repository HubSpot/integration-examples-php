<?php

use Helpers\Oauth2Helper;
use Repositories\EventsRepository;

include_once '../../vendor/autoload.php';

session_start();
$uri = parse_url($_SERVER["REQUEST_URI"])['path'];

try {
    \Helpers\DBClientHelper::runMigrations();

    switch ($uri) {
        // allowed for anonymous
        case '/oauth/login.php':
        case '/oauth/authorize.php':
        case '/oauth/callback.php':
        case '/telegram/registration.php':
            $path = __DIR__ . '/../actions' . $uri;
            require $path;
            exit();
    }

    if (!Oauth2Helper::isAuthenticated()) {
        header('Location: /oauth/login.php');
        exit();
    }

    switch ($uri) {
        // protected
        case '/' :
            header('Location: /types/list.php');
            exit();
        case '/types/new.php':
        case '/types/show.php':
        case '/types/list.php':
        case '/types/update.php':
        case '/types/delete.php':
        case '/types/properties/new.php':
        case '/types/properties/list.php':
        case '/types/properties/update.php':
        case '/types/properties/delete.php':
            $path = __DIR__ . '/../actions' . $uri;
            require $path;
            exit();
        default:
            http_response_code(404);
            exit();
    }
} catch (Throwable $t) {
    $message = $t->getMessage();
    include __DIR__ . '/../views/error.php';
    exit();
}
