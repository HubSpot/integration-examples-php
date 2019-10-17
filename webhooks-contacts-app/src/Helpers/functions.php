<?php
/**
 * @param string $name
 * @param null $default
 * @return mixed|null
 */
function getEnvParam(string $name, $default = null) {
    if (!empty($_ENV[$name])) {
        return $_ENV[$name];
    }
    return $default;
}

/**
 * @param string $name
 * @param null $default
 * @return mixed|null
 */
function getEnvOrException(string $name) {
    if (empty($_ENV[$name])) {
        throw new \Exception("Please specify $name in .env");
    }
    return $_ENV[$name];
}

function verify_hubspot_signature() {
    $requestSignature = $_SERVER['HTTP_X_HUBSPOT_SIGNATURE'];
    $requestBody = file_get_contents('php://input');
    $clientSecret = $_ENV['HUBSPOT_CLIENT_SECRET'];
    $requiredSignature = hash('sha256', $clientSecret.$requestBody);
    if ($requestSignature !== $requiredSignature) {
        header("HTTP/1.1 401 Unauthorized");
        exit();
    }
}