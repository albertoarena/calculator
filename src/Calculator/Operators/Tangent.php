<?php

namespace Calculator\Operators;

use Calculator\Exceptions\InfiniteException;

class Tangent extends TrigonometricOperator
{
    public function getOperator(): string
    {
        return 'tan';
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
     * @throws InfiniteException
     */
    public function execute(float|int|null $value1, float|int|null $value2): float|int
    {
        if (in_array($this->toDegrees($value2), [90.0, 270.0])) {
            throw new InfiniteException;
        }

        return $this->toResult(
            tan($this->toRadians($value2))
        );
    }

    public function getStringBrackets(): bool
    {
        return true;
    }
}
