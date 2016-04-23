<?php

namespace Calculator\Exception;


class InvalidNumberException extends Exception
{

    public function __construct($value)
    {
        parent::__construct('Invalid number: ' . (is_scalar($value) ? $value : print_r($value, 1)));
    }
} 