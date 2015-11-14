<?php

namespace Calculator\Exception;


abstract class Exception extends \Exception
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
} 