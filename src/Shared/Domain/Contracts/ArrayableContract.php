<?php

declare(strict_types=1);

namespace Src\Shared\Domain\Contracts;

interface ArrayableContract
{
    /**
     * Get the instance as an array.
     *
     * @return array<TKey, TValue>
     */
    public function toArray();
}
