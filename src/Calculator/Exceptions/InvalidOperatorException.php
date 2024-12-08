<?php

namespace Calculator\Exceptions;

class InvalidOperatorException extends Exception
{
    public function __construct($operator)
    {
        parent::__construct('Invalid operator: '.$operator);
    }
}
