<?php

declare(strict_types=1);

namespace Src\Shared\Domain\Contracts;

use ArrayAccess;
use ArrayIterator;
use Countable;
use IteratorAggregate;

abstract class CollectionContract implements Countable, ArrayAccess, IteratorAggregate, ArrayableContract
{
    protected array $values;

    public function count() : int {
        return count($this->values);
    }

    public function offsetExists(mixed $offset): bool
    {
        return isset($this->values[$offset]);
    }

    public function offsetGet(mixed $offset)
    {
        return $this->values[$offset];
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->values[$offset] = $value;
    }

    public function offsetUnset(mixed $offset): void
    {
        unset($this->values[$offset]);
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->values);
    }
    
    public function toArray() : array {
        $result = [];
        foreach($this->values as $value) {
            array_push($result, $value->toArray());
        }
        return $result;
    }
}
