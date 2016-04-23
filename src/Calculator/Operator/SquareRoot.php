<?php
namespace Calculator\Operator;


class SquareRoot extends Operator
{
    /**
     * @return string
     */
    public function getOperator()
    {
        return '√';
    }

    /**
     * @return int
     */
    public function getPrecedence()
    {
        return self::PRECEDENCE_HIGH;
    }

    /**
     * @return int
     */
    public function getStringOrder()
    {
        return -1;
    }

    /**
     * @param float|int $value1 Unused
     * @param float|int $value2
     * @return float|int
     */
    public function execute($value1, $value2)
    {
        return sqrt($value2);
    }
}