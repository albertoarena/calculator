<?php

namespace Tests\Models;

readonly class TestOperator
{
    public array $values;

    public function __construct(
        public int|float|string $value1,
        public int|float|string $value2,
        public int|float|string $expected,
    ) {
        $this->values = [$this->value1, $this->value2];
    }
}
