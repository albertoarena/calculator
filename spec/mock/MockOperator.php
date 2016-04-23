<?php
namespace spec\mock;


use Calculator\Operator\Operator;

class MockOperator extends Operator
{

    public function getOperator()
    {
        return '$';
    }

    public function getPrecedence()
    {
        return self::PRECEDENCE_LOW;
    }


    public function execute($value1, $value2)
    {
        return $value1;
    }
} 