<?php

declare(strict_types=1);

namespace Src\Game\Application;

use Src\Game\Domain\Contracts\GameRepositoryContract;
use Src\Game\Domain\ValueObjects\GameCollection;

final class GetAllGamesUseCase
{
    private $repository;

    public function __construct(GameRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): GameCollection
    {
        return $this->repository->all();
    }
}
