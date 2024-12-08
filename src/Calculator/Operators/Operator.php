<?php

namespace Calculator\Operators;

use Calculator\Contracts\MathInterface;
use Calculator\Contracts\OperatorInterface;
use Calculator\Entity;

abstract class Operator extends Entity implements OperatorInterface
{
    /** @internal higher precedence */
    public const PRECEDENCE_HIGH = 3;

    /** @internal higher precedence */
    public const PRECEDENCE_MEDIUM = 2;

    /** @internal lower precedence */
    public const PRECEDENCE_LOW = 1;

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
