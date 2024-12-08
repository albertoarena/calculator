<?php

namespace Calculator\Exceptions;

class NotANumberException extends Exception
{
    public function __construct()
    {
        parent::__construct('Not a number (NAN)');
    }
}
