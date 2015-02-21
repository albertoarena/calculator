<?php
namespace Calculator\Operator;


class Divide extends Operator
{
    /**
     * @return string
     */
    public function getOperator()
    {
        return '/';
    }

    /**
     * @param float|int $value1
     * @param float|int $value2
     * @return float|int
     */
    public function execute($value1, $value2)
    {
        return $value1 / $value2;
    }
}