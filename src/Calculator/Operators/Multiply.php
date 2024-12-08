<?php

namespace Calculator\Operators;

class Multiply extends Operator
{
    public function getOperator(): string
    {
        return '*';
    }

    public function getPrecedence(): int
    {
        return self::PRECEDENCE_MEDIUM;
    }

    public function execute(float|int|null $value1, float|int|null $value2): float|int
    {
        return $value1 * $value2;
    }
}
