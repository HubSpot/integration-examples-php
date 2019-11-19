<?php

include_once '../../vendor/autoload.php';

try {
    session_start();
    $uri = parse_url($_SERVER["REQUEST_URI"])['path'];
    $publicUrls = [
        '/forms/init.php',
        '/webhooks/handle.php'
    ];
    if (empty($_SESSION['FORM']) && !in_array($uri, $publicUrls)) {
        header('Location: /forms/init.php');
        exit();
    }
    switch ($uri) {
        case '/' :
            header('Location: /contacts/list.php');
            exit();
        case '/forms/init.php':
        case '/forms/form.php':
        case '/contacts/list.php':
        case '/webhooks/handle.php':
            $path = __DIR__ .'/../actions'. $uri;
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
