<?php

namespace Calculator\Exceptions;

abstract class Exception extends \Exception
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}
