<?php

declare(strict_types=1);

namespace Src\Game\Domain\ValueObjects;

use Src\Game\Domain\GameEntity;
use Src\Shared\Domain\Contracts\CollectionContract;

final class GameCollection extends CollectionContract
{
    public function __construct(GameEntity ...$values)
    {
        $this->values = $values;
    }

}
