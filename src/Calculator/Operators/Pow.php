<?php

namespace Calculator\Operators;

use Calculator\Exceptions\DivisionByZeroException;

class Pow extends Operator
{
    public function getOperator(): string
    {
        return '^';
    }

    public function getPrecedence(): int
    {
        return self::PRECEDENCE_HIGH;
    }

    /**
     * @throws DivisionByZeroException
     */
    public function execute(float|int|null $value1, float|int|null $value2): float|int
    {
        // PHP 8.4: Raising zero to the power of a negative number is now deprecated.
        // See https://wiki.php.net/rfc/raising_zero_to_power_of_negative_number
        if ($value2 < 0) {
            throw new DivisionByZeroException;
        }

        return pow($value1, $value2);
    }
}
