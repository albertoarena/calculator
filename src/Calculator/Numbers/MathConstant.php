<?php

namespace Calculator\Numbers;

class MathConstant
{
    public function __construct(
        public string $constant,
        public float|int $value,
        public bool $greekLetters = false,
    ) {}
}
