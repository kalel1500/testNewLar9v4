<?php

declare(strict_types=1);

namespace Src\Post\Domain\ValueObjects;

final class PostPublished
{
    private bool $isPublished;

    public function __construct(bool $isPublished)
    {
        $this->isPublished = $isPublished;
    }

    public function value(): bool
    {
        return $this->isPublished;
    }

}
