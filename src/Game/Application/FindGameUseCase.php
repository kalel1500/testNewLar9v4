<?php

declare(strict_types=1);

namespace Src\Game\Application;

use Src\Game\Domain\Contracts\GameRepositoryContract;
use Src\Game\Domain\GameEntity;
use Src\Game\Domain\ValueObjects\GameId;

final class FindGameUseCase
{
    private $repository;

    public function __construct(GameRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $id): ?GameEntity
    {
        return $this->repository->find(new GameId($id));
    }
}
