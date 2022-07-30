<?php

declare(strict_types=1);

namespace Src\Game\Application\ViewsData;

use Src\Game\Domain\GameEntity;

final class GameViewData
{
    public function __construct(
        public GameEntity $game,
    )
    {
    }
}
