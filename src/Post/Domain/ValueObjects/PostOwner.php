<?php

declare(strict_types=1);

namespace Src\Post\Domain\ValueObjects;

use Src\Shared\Domain\Exceptions\IdNotFound;

final class PostOwner
{
    private int $userId;

    public function __construct(int $userId)
    {
        $this->setUserId($userId);
    }

    public function value(): int
    {
        return $this->userId;
    }

    private function setUserId(int $userId): void
    {
        if ($userId < 0) {
            throw new IdNotFound($userId);
        }

        $this->userId = $userId;
    }
}
