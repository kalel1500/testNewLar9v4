<?php

declare(strict_types=1);

namespace Src\Post\Domain\ValueObjects;

final class PostContent
{
    private string $content;

    public function __construct(string $content)
    {
        $this->content = $content;
    }

    public function value(): string
    {
        return $this->content;
    }

}
