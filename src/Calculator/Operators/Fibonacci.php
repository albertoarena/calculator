<?php

namespace Calculator\Operators;

use Calculator\Contracts\HasPhi;
use Calculator\Exceptions\InvalidNumberException;

class Fibonacci extends Operator
{
    use HasPhi;

    public function getOperator(): string
    {
        return '!';
    }

    public function getPrecedence(): int
    {
        return self::PRECEDENCE_HIGH;
    }

    /**
     * @throws InvalidNumberException
     */
    public function execute(float|int|null $value1, float|int|null $value2): float|int
    {
        if ($value2 < 0) {
            throw new InvalidNumberException($value2);
        }

        if ($value2 > 100) {
            throw new InvalidNumberException($value2);
        }

        if ($value2 <= 1) {
            return $value2;
        }

        // Computation by rounding, see https://en.wikipedia.org/wiki/Fibonacci_sequence#Computation_by_rounding
        return round(pow($this->getPhi(), $value2) / sqrt(5));
    }
}
