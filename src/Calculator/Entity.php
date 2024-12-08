<?php

namespace Calculator;

use Calculator\Contracts\EntityInterface;

abstract class Entity implements EntityInterface
{
    public function getStringOrder(): int
    {
        return 1;
    }

    public function getStringBrackets(): bool
    {
        return false;
    }
}
