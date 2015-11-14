<?php

namespace Calculator\Exception;


class DivisionByZeroException extends Exception {

    public function __construct()
    {
        parent::__construct('Division by zero');
    }
} 