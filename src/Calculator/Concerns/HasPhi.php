<?php

namespace Calculator\Concerns;

trait HasPhi
{
    protected static ?float $phi = null;

    protected static function getPhi(): float
    {
        if (null === self::$phi) {
            self::$phi = (1 + sqrt(5)) / 2;
        }

        return self::$phi;
    }
}
