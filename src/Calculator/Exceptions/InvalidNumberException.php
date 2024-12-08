<?php

namespace Calculator\Exceptions;

class InvalidNumberException extends Exception
{
    public function __construct($value)
    {
        parent::__construct('Invalid number: '.(is_scalar($value) ? $value : print_r($value, true)));
    }
}
