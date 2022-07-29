<?php

use Src\Shared\Domain\ValueObjects\AppJsonResponse;

if (!function_exists('arrayJsonResponse')) {
    function arrayJsonResponse($statusCode, $message, $data)
    {
        $resp = new AppJsonResponse($statusCode, $message, $data);
        return $resp->toArray();
    }
}

if (!function_exists('isValidBoolean')) {
    function isValidBoolean($value)
    {
        return !(is_int($value) && ($value !== 0 && $value !== 1));
    }
}