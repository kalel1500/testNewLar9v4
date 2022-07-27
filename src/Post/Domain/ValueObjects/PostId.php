<?php

declare(strict_types=1);

namespace Src\Post\Domain\ValueObjects;

use Src\Shared\Domain\Exceptions\IdNotFound;

final class PostId
{
    private int $id;

    public function __construct(int $id)
    {
        $this->setId($id);
    }

    public function value(): int
    {
        return $this->id;
    }

    private function setId(int $id): void
    {
        if (!is_null($id) && $id < 0) {
            throw new IdNotFound($id);
        }

        $this->id = $id;
    }
}
