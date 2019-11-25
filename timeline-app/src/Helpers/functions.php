<?php
/**
 * @param string $name
 * @param array $array
 * @return mixed|null
 */
function getValueOrNull(string $name, array $array)
{
    if (array_key_exists($name, $array)) {
        return $array[$name];
    }
    return null;
}

/**
 * @param string $name
 * @param null $default
 * @return mixed|null
 */
function getEnvOrException(string $name)
{
    if (empty($_ENV[$name])) {
        throw new \Exception("Please specify $name in .env");
    }
    return $_ENV[$name];
}

/**
 * 
 * @param array $fields
 * @param array $data
 * @return array
 */
function getDataFromPost(array $fields, array $data = []): array
{
    foreach ($fields as $field) {
        if (array_key_exists($field, $_POST)) {
            $data[$field] = trim(htmlspecialchars($_POST[$field]));
        }
        if (!array_key_exists($field, $data)) {
            $data[$field] = null;
        }
    }
    
    return $data;
}
