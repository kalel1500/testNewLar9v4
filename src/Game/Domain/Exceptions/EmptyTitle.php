<?php

declare(strict_types=1);

namespace Src\Post\Domain\Exceptions;

final class EmptyTitle extends \DomainException
{

    public function __construct(string $id)
    {
        //
    }

}
