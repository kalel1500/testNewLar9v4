<?php

declare(strict_types=1);

namespace Src\Game\Application\ViewsData;

use Src\Game\Domain\GameEntity;

final class FormGameViewData
{
    public function __construct(
        public bool $isUpdate,
        public GameEntity $game,
    )
    {
    }

}
