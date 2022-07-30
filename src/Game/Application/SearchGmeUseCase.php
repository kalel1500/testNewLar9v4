<?php

declare(strict_types=1);

namespace Src\Game\Application;

use Src\Game\Domain\Contracts\GameRepositoryContract;
use Src\Game\Domain\ValueObjects\GameCollection;
use Src\Game\Domain\ValueObjects\GameTitle;

final class SearchGmeUseCase
{
    private $repository;

    public function __construct(GameRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $title): GameCollection
    {
        return $this->repository->sarch(new GameTitle($title));
    }
}
