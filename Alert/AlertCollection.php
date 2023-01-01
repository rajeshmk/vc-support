<?php

namespace Vocolabs\Support\Alert;

use Vocolabs\Support\Exception\VocolabsException;
use Vocolabs\Support\Support\Collection;

class AlertCollection extends Collection
{
    public function all(string $cast = 'array'): array
    {
        $bag = [];
        foreach ($this->items as $alert) {
            $bag[] = match($cast) {
                'html', 'bootstrap' => $alert->bootstrap(),
                'array', 'json' => $alert->toArray(),
                default => throw new VocolabsException('Casting to ' . $cast . ' is not permitted!'),
            };
        }

        return $bag;
    }
}
