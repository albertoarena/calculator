<?php

namespace Calculator\Operators;

class Percentage extends Operator
{
    public function getOperator(): string
    {
        return '%';
    }

    public function getPrecedence(): int
    {
        return self::PRECEDENCE_HIGH;
    }

    public function execute(float|int|null $value1, float|int|null $value2): float|int
    {
        return $value2 / 100;
    }
}
