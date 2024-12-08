<?php

namespace Calculator\Numbers;

class Result extends Number
{
    public function getType(): string
    {
        return 'result';
    }

    public function __toString()
    {
        return '= '.$this->round();
    }
}
