<?php

namespace Tests\Models;

readonly class TestValue
{
    public function __construct(
        public int|float|string $value,
        public string $expected,
    ) {}
}
