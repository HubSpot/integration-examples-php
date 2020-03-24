<?php

include_once '../../vendor/autoload.php';

try {
    session_start();
    $uri = parse_url($_SERVER['REQUEST_URI'])['path'];
    
    // get all routes
    $routes = require '../routes/all.php';
    
    if ('/' === $uri) {
        header('Location: /contacts/list.php');
        exit();
    }
    
    if (!in_array($uri, $routes)) {
        http_response_code(404);
        exit();
    }

    $path = __DIR__.'/../actions'.$uri;
    require $path;
} catch (Throwable $t) {
    $message = $t->getMessage();
    include __DIR__.'/../views/error.php';
    exit();
}
