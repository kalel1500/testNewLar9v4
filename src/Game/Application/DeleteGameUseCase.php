<?php

declare(strict_types=1);

namespace Src\Game\Application;

use Src\Game\Domain\Contracts\GameRepositoryContract;
use Src\Game\Domain\ValueObjects\GameId;

final class DeleteGameUseCase
{
    private $repository;

    public function __construct(GameRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $id): void
    {
        $this->repository->delete(new GameId($id));
    }
}
