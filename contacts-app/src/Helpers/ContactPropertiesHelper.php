<?php


namespace Helpers;


class ContactPropertiesHelper
{
    public static function isEditable($property) {
        if ($property->readOnlyValue || $property->calculated) {
            return false;
        }
        return true;
    }
}