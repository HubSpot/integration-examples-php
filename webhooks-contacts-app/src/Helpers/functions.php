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