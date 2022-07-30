<?php

declare(strict_types=1);

namespace Src\Game\Domain\Exceptions;

final class EmptyTitle extends \DomainException
{

    public function __construct(string $id)
    {
        //
    }

}
