<?php

declare(strict_types=1);

namespace Src\Game\Application\ViewsData;

use Src\Game\Domain\ValueObjects\GameCollection;

final class ListGamesViewData
{
    public function __construct(
        public GameCollection $games,
    )
    {
    }

}
