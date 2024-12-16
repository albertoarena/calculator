<?php

namespace Calculator\Contracts;

interface OperatorInterface extends EntityInterface
{
    /** @internal higher precedence */
    public const PRECEDENCE_HIGH = 3;

    /** @internal higher precedence */
    public const PRECEDENCE_MEDIUM = 2;

    /** @internal lower precedence */
    public const PRECEDENCE_LOW = 1;

    public function getOperator(): string;

    public function getPrecedence(): int;

    public function execute(float|int|null $value1, float|int|null $value2): float|int;

    public function useRadians(): bool;
}
