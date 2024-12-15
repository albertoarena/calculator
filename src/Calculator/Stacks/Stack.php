<?php

namespace Calculator\Stacks;

use Calculator\Numbers\Number;
use Calculator\Operators\Operator;

class Stack
{
    /** @var Number[]|Operator[] */
    protected array $stack;

    public function __construct()
    {
        $this->stack = [];
    }

    public function push(Number|Operator $item): void
    {
        $this->stack[] = $item;
    }

    public function pop(): Number|Operator
    {
        return array_pop($this->stack);
    }

    public function prepend(Number|Operator $item): void
    {
        array_unshift($this->stack, $item);
    }

    public function shift(): Number|Operator
    {
        return array_shift($this->stack);
    }

    public function count(): int
    {
        return count($this->stack);
    }

    public function reset(): void
    {
        $this->stack = [];
    }

    public function current(): Number|Operator|null
    {
        if ($c = count($this->stack)) {
            return $this->stack[$c - 1];
        }

        return null;
    }
}
