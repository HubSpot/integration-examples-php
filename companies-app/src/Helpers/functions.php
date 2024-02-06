<?php

function outProperty(stdClass $object, string $property): mixed
{
    $value = null;
    if (property_exists($object->properties, $property)){
        $value = $object->properties?->$property?->value;
    }

    return $value;
}


function outString(string|null $string, string $default = '-'): string
{
    if (empty($string)) {
        return $default;
    }

    return $string;
}

/**
 * @param string $name
 *
 * @return null|mixed
 */
function getEnvOrException(string $name)
{
    if (empty($_ENV[$name])) {
        throw new \Exception("Please specify {$name} in .env");
    }

    return $_ENV[$name];
}
