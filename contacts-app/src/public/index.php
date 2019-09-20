<?php

include_once '../../vendor/autoload.php';

try {
    session_start();
    $uri = parse_url($_SERVER["REQUEST_URI"])['path'];
    switch ($uri) {
        case '/' :
            header('Location: /contacts/list.php');
            exit();
        case '/contacts/list.php':
        case '/contacts/new.php':
        case '/contacts/show.php':
        case '/contacts/search.php':
        case '/properties/list.php':
        case '/properties/new.php':
        case '/properties/show.php':
        case '/oauth/authorize.php':
        case '/oauth/callback.php':
            $path = __DIR__ .'/../actions'. $uri;
            require $path;
            exit();
        default:
    }

} catch (Throwable $t) {
    $message = $t->getMessage();
    include __DIR__.'/../views/error.php';
    exit();
}
