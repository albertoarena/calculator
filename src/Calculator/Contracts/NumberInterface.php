<?php

namespace Calculator\Contracts;

interface NumberInterface extends EntityInterface
{
    public function getValue(): float|int;
}
