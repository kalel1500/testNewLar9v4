<?php

declare(strict_types=1);

namespace Src\Shared\Domain\ValueObjects;

use InvalidArgumentException;

final class AppJsonResponse
{
    public function __construct(
        public bool|int $statusCode = 1,
        public string $message = 'Success',
        public array $data = [],
    )
    {
        $this->ensureStatusCodeIsValidId($statusCode);
    }

    public function toArray()
    {
        return [
            'statusCode' => $this->statusCode,
            'message' => $this->message,
            'data' => $this->data,
        ];
    }
    
    private function ensureStatusCodeIsValidId(bool|int $value): void
    {
        if (!isValidBoolean($value)) {
            throw new InvalidArgumentException(sprintf('<%s> does not allow the value <%s>.', static::class, $value));
        }
    }

}
