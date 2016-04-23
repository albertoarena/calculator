<?php

namespace Calculator\Exception;


class InvalidOperatorException extends Exception
{

    public function __construct($operator)
    {
        parent::__construct('Invalid operator: ' . $operator);
    }
} 