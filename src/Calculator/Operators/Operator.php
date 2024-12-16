<?php

namespace Calculator\Operators;

use Calculator\Contracts\MathInterface;
use Calculator\Contracts\OperatorInterface;
use Calculator\Entity;

abstract class Operator extends Entity implements OperatorInterface
{
    public function __construct(
        readonly public int $precision = MathInterface::PRECISION,
    ) {}

    public function getType(): string
    {
        return 'operator';
    }

    public function __toString()
    {
        return $this->getOperator();
    }

    public function useRadians(): bool
    {
        return false;
    }
}
