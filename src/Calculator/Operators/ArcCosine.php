<?php

namespace Calculator\Operators;

use Calculator\Exceptions\NotANumberException;

class ArcCosine extends TrigonometricOperator
{
    public function getOperator(): string
    {
        return 'acos';
    }

    public function getPrecedence(): int
    {
        return self::PRECEDENCE_MEDIUM;
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
        if ($value2 < -1 || $value2 > 1) {
            throw new NotANumberException;
        }

        return $this->toResult(
            acos($value2)
        );
    }

    public function getStringBrackets(): bool
    {
        return true;
    }
}
