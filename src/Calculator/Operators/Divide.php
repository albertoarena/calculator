<?php

namespace Calculator\Operators;

use Calculator\Exceptions\DivisionByZeroException;

class Divide extends Operator
{
    public function getOperator(): string
    {
        return '/';
    }

    public function getPrecedence(): int
    {
        return self::PRECEDENCE_MEDIUM;
    }

    /**
     * @throws DivisionByZeroException
     */
    public function execute(float|int|null $value1, float|int|null $value2): float|int
    {
        if (0 == $value2) {
            throw new DivisionByZeroException;
        }

        return $value1 / $value2;
    }
}
