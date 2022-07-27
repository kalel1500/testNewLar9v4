<?php

declare(strict_types=1);

namespace Src\Shared\Domain\Exceptions;

final class AppJsonResponse
{
    public function __construct(
        public bool $statusCode = 1,
        public string $message = 'Success',
        public array $data = [],
    )
    {}

    public function toArray()
    {
        return [
            'statusCode' => $this->statusCode,
            'message' => $this->message,
            'data' => $this->data,
        ];
    }

}
