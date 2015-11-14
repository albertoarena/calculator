<?php
namespace Calculator\Operator;


class Pow extends Operator
{
    /**
     * @return string
     */
    public function getOperator()
    {
        return '^';
    }

    /**
     * @return int
     */
    public function getPrecedence()
    {
        return self::PRECEDENCE_HIGH;
    }

    /**
     * @param float|int $value1
     * @param float|int $value2
     * @return float|int
     */
    public function execute($value1, $value2)
    {
        return pow($value1, $value2);
    }
}