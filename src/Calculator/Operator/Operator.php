<?php
namespace Calculator\Operator;


abstract class Operator
{
    /**
     * @return string
     */
    abstract public function getOperator();

    /**
     * @param float|int $value1
     * @param float|int $value2
     * @return float|int
     */
    abstract public function execute($value1, $value2);
}