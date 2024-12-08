<?php

namespace Calculator\Operators;

use Calculator\Exceptions\NotANumberException;

class SquareRoot extends Operator
{
    public function getOperator(): string
    {
        return '√';
    }

    public function getPrecedence(): int
    {
        return self::PRECEDENCE_HIGH;
    }

    public function getStringOrder(): int
    {
        return -1;
    }

    /**
     * @throws NotANumberException
     */
    public function execute(float|int|null $value1, float|int|null $value2): float|int
    {
        if ($value2 < 0) {
            throw new NotANumberException;
        }

        return sqrt($value2);
    }
}
