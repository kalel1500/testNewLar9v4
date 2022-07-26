<?php

declare(strict_types=1);

namespace Src\Employee\Domain\Exceptions;


final class IncorrectHours extends \DomainException
{

    public function __construct(string $id)
    {
        //
    }

}
