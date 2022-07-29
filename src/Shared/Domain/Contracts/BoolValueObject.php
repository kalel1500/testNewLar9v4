<?php

declare(strict_types=1);

namespace Src\Shared\Domain\Contracts;

use InvalidArgumentException;

abstract class BoolValueObject
{
    public function __construct(
        protected bool|int $value
    )
    {
        $this->ensureIsValidId($value);
    }

    public function value(): bool
    {
        return $this->value;
    }
    
    private function ensureIsValidId(bool|int $value): void
    {
        if (!isValidBoolean($value)) {
            throw new InvalidArgumentException(sprintf('<%s> does not allow the value <%s>.', static::class, $value));
        }
    }
}
