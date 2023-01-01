<?php

namespace Vocolabs\Support\Support;

use ArrayAccess;

abstract class Collection implements ArrayAccess
{
    abstract public function all(string $cast = 'array'): array;

    public function __construct(protected array $items = [])
    {
        //
    }

    public function offsetSet(mixed $key, mixed $value): void
    {
        if (is_null($key)) {
            $this->items[] = $value;
        } else {
            $this->items[$key] = $value;
        }
    }

    public function offsetExists(mixed $key): bool
    {
        return isset($this->items[$key]);
    }

    public function offsetUnset(mixed $key): void
    {
        unset($this->items[$key]);
    }

    public function offsetGet(mixed $key): mixed
    {
        return $this->items[$key] ?? null;
    }

    public function count(): int
    {
        return count($this->items);
    }
}
