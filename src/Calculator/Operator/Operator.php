<?php
namespace Calculator\Operator;


abstract class Operator
{
    public function __construct()
    {
    }

    abstract public function getOperator();

    abstract public function execute($value1, $value2);
}