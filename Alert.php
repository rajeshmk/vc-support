<?php

namespace Vocolabs\Support;

use Vocolabs\Support\Alert\AlertCollection;
use Vocolabs\Support\Alert\AlertMessage;
use Vocolabs\Support\Exception\VocolabsException;

class Alert
{
    private static array $alerts = [];

    public static function __callStatic($name, $arguments): AlertMessage
    {
        if (! in_array($name, ['success', 'info', 'warning', 'error', 'exception'])) {
            throw new VocolabsException('Bad method call: ' . self::class . '::' . $name . '(...)');
        }

        return self::alert($name, ...$arguments);
    }

    public static function alert(string $type, string $message): AlertMessage
    {
        self::$alerts[] = $alert = new AlertMessage($message, $type);

        return $alert;
    }

    public static function hasAlert(): bool
    {
        return self::$alerts !== [];
    }

    public static function has(string $type): bool
    {
        foreach (self::$alerts as $alert) {
            if ($alert->is($type)) {
                return true;
            }
        }

        return false;
    }

    public static function collection()
    {
        return new AlertCollection(self::$alerts);
    }
}
