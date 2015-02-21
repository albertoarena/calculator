<?php
namespace Calculator\Operator;


class Subtract extends Operator
{
    public function getOperator()
    {
        return '-';
    }

    public function execute($value1, $value2)
    {
        return $value1 - $value2;
    }
}