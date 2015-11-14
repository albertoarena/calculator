<?php
namespace Calculator\Operator;


use Calculator\Exception\DivisionByZeroException;

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
     * @throws \Calculator\Exception\DivisionByZeroException
     */
    public function execute($value1, $value2)
    {
        if ($value2 == 0) {
            throw new DivisionByZeroException();
        }
        return $value1 / $value2;
    }
}