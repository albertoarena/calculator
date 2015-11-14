<?php
namespace Calculator\Operator;


class Multiply extends Operator
{
    /**
     * @return string
     */
    public function getOperator()
    {
        return '*';
    }

    /**
     * @return int
     */
    public function getPrecedence()
    {
        return self::PRECEDENCE_MEDIUM;
    }

    /**
     * @param float|int $value1
     * @param float|int $value2
     * @return float|int
     */
    public function execute($value1, $value2)
    {
        return $value1 * $value2;
    }
}