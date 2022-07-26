<?php

declare(strict_types=1);

namespace Src\Employee\Domain\Exceptions;


final class IdNotFound extends \DomainException
{

    public function __construct(int $id)
    {
        //
    }

}
