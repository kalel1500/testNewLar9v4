<?php

declare(strict_types=1);

namespace Src\Post\Domain\ValueObjects;

use Src\Post\Domain\PostEntity;
use Src\Shared\Domain\Contracts\CollectionContract;

final class PostCollection extends CollectionContract
{
    public function __construct(PostEntity ...$values)
    {
        $this->values = $values;
    }

}
