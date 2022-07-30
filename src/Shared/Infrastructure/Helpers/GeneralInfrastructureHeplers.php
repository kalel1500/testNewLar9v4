<?php

use Src\Shared\Domain\ValueObjects\AppJsonResponse;

if (!function_exists('arrayJsonResponse')) {
    function arrayJsonResponse($statusCode, $message, $data)
    {
        $resp = new AppJsonResponse($statusCode, $message, $data);
        return $resp->toArray();
    }
}
