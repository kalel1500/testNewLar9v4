<?php

declare(strict_types=1);

namespace Src\Post\Domain\ValueObjects;

use Src\Post\Domain\Exceptions\EmptyTitle;

final class PostTitle
{
    private string $title;

    public function __construct(string $title)
    {
        $this->setTitle($title);
    }

    public function value(): string
    {
        return $this->title;
    }

    private function setTitle(string $title): void
    {
        if ($title === '') {
            throw new EmptyTitle("El titulo no puede ser una cadena vacia");
        }
        $this->title = $title;
    }
}
