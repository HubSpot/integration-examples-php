<?php

include_once '../../vendor/autoload.php';

try {
    session_start();

    \Helpers\DBClientHelper::runMigrations();

    $publicRoutes = require '../routes/public.php';
    $protectedRoutes = require '../routes/protected.php';

    $uri = parse_url($_SERVER['REQUEST_URI'])['path'];
    if ('/' === $uri) {
        header('Location: /contacts/list.php');
        exit();
    }



    if (in_array($uri, $protectedRoutes)) {
        if (!\Helpers\OAuth2Helper::isAuthenticated()) {
            header('Location: /oauth/login.php');
            exit();
        }
        if (empty($_SESSION['FORM']) && $uri !== '/forms/init.php') {
            header('Location: /forms/init.php');
            exit();
        }
    }

    if (!in_array($uri, array_merge($publicRoutes, $protectedRoutes))) {
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
