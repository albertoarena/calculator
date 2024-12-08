<?php

namespace Calculator\Contracts;

interface OperatorInterface extends EntityInterface
{
    public function getOperator(): string;

    public function getPrecedence(): int;

    public function execute(float|int|null $value1, float|int|null $value2): float|int;

    public function useRadians(): bool;
}
