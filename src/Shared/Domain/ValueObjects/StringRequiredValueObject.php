<?php

declare(strict_types=1);

namespace Src\Shared\Domain\ValueObjects;

use InvalidArgumentException;

abstract class StringRequiredValueObject
{
    public function __construct(
        protected string $value
    )
    {
        $this->ensureIsValidId($value);
    }

    public function value(): string
    {
        return $this->value;
    }
    
    private function ensureIsValidId(string $value): void
    {
        if ($value === '') {
            throw new InvalidArgumentException(sprintf('<%s> does not allow the value <%s>.', static::class, $value));
        }
    }
}
