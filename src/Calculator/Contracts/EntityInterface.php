<?php

namespace Calculator\Contracts;

interface EntityInterface
{
    /**
     * Get type
     */
    public function getType(): string;

    /**
     * Get string order, when the calculation is represented by a string
     * 1: right side (default), -1: left side
     */
    public function getStringOrder(): int;

    public function __toString();

    /**
     * Used only with getStringOrder() --> -1
     * If return true, the number is put between parenthesis in string representation
     */
    public function getStringBrackets(): bool;
}
