<?php

declare(strict_types=1);

namespace Src\Game\Domain\Contracts;

use Src\Game\Domain\GameEntity;
use Src\Game\Domain\ValueObjects\GameCollection;
use Src\Game\Domain\ValueObjects\GameId;
use Src\Game\Domain\ValueObjects\GameTitle;

interface GameRepositoryContract
{
    public function all(): GameCollection;
    public function find(GameId $id): ?GameEntity;
    public function sarch(GameTitle $title): GameCollection;
    public function save(GameEntity $game): void;
    public function update(GameId $id, GameEntity $game): void;
    public function delete(GameId $id): void;
}
