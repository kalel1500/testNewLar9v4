<?php

declare(strict_types=1);

namespace Src\Shared\Domain\Contracts;

abstract class BoolValueObject
{
    public function __construct(
        protected bool $value
    )
    {
    }

    public function value(): bool
    {
        return $this->value;
    }
}
