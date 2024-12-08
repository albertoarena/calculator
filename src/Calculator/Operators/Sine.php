<?php

namespace Calculator\Operators;

class Sine extends TrigonometricOperator
{
    public function getOperator(): string
    {
        return 'sin';
    }

    public function getPrecedence(): int
    {
        return self::PRECEDENCE_MEDIUM;
    }

    public function getStringOrder(): int
    {
        return -1;
    }

    public function execute(float|int|null $value1, float|int|null $value2): float|int
    {
        return $this->toResult(
            sin($this->toRadians($value2))
        );
    }

    public function getStringBrackets(): bool
    {
        return true;
    }
}
