<?php

namespace Calculator\Exceptions;

class DivisionByZeroException extends Exception
{
    public function __construct()
    {
        parent::__construct('Division by zero');
    }
}
