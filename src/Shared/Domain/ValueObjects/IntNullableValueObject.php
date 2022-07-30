<?php

declare(strict_types=1);

namespace Src\Shared\Domain\ValueObjects;

use InvalidArgumentException;

abstract class IntNullableValueObject
{
    public function __construct(
        protected ?int $value
    )
    {
        $this->ensureIsValidId($value);
    }

    public function value(): ?int
    {
        return $this->value;
    }

    public function isBiggerThan(IntValueObject $other): bool
    {
        return $this->value() > $other->value();
    }
    
    public function equals(IntValueObject $other): bool
    {
        return $this->value() === $other->value();
    }
    
    private function ensureIsValidId(?int $id): void
    {
        if (!is_null($id) && $id < 0) {
            throw new InvalidArgumentException(sprintf('<%s> does not allow the value <%s>.', static::class, $id));
        }
    }

}
