<?php

use Src\Shared\Domain\Exceptions\AppJsonResponse;

if (!function_exists('arrayJsonResponse')) {
    function arrayJsonResponse($statusCode, $message, $data)
    {
        $resp = new AppJsonResponse($statusCode, $message, $data);
        return $resp->toArray();
    }
}