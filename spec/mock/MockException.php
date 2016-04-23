<?php
namespace spec\mock;

use Calculator\Exception\Exception;

class MockException extends Exception
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
} 