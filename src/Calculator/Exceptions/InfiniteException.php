<?php

namespace Calculator\Exceptions;

class InfiniteException extends Exception
{
    public function __construct()
    {
        parent::__construct('Result is infinite');
    }
}
