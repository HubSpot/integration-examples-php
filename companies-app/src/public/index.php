<?php

use Helpers\Oauth2Helper;

include_once '../../vendor/autoload.php';

session_start();
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

try {
    switch ($uri) {
        // allowed for anonymous
        case '/oauth/login.php':
        case '/oauth/authorize.php':
        case '/oauth/callback.php':
        $path = __DIR__.'/../actions'.$uri;
            require $path;
            exit();
    }

    if (!Oauth2Helper::isAuthenticated()) {
        header('Location: /oauth/login.php');
        exit();
    }

    switch ($uri) {
        // protected
        case '/':
            header('Location: /companies/list.php');
            exit();
        case '/companies/new.php':
        case '/companies/list.php':
        case '/companies/search.php':
        case '/companies/contacts.php':
        case '/companies/show.php':
        case '/oauth/authorize.php':
        case '/oauth/callback.php':
            $path = __DIR__.'/../actions'.$uri;
            require $path;
            exit();
        default:
            http_response_code(404);
            exit();
    }
} catch (Throwable $t) {
    $message = $t->getMessage();
    include __DIR__.'/../views/error.php';
    exit();
}
