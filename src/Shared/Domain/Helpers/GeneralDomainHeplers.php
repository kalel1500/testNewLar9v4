<?php

if (!function_exists('isValidBoolean')) {
    function isValidBoolean($value)
    {
        return !(is_int($value) && ($value !== 0 && $value !== 1));
    }
}