<?php

declare(strict_types=1);

namespace Src\Game\Application;

use Src\Game\Domain\Contracts\GameRepositoryContract;
use Src\Game\Domain\GameEntity;
use Src\Game\Domain\ValueObjects\GameCompany;
use Src\Game\Domain\ValueObjects\GameDescription;
use Src\Game\Domain\ValueObjects\GameId;
use Src\Game\Domain\ValueObjects\GameTitle;
use Src\Game\Domain\ValueObjects\GameYear;

final class StoreGameUseCase
{
    private $repository;

    public function __construct(GameRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $title,
        string $desciption,
        int $year,
        int $company_id
    ): void
    {
        $id             = new GameId(null);
        $title          = new GameTitle($title);
        $desciption     = new GameDescription($desciption);
        $year           = new GameYear($year);
        $company_id     = new GameCompany($company_id);

        $user = GameEntity::create($id, $title, $desciption, $year, $company_id);

        $this->repository->save($user);
    }
}
