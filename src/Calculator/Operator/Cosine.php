<?php
namespace Calculator\Operator;


class Cosine extends Operator
{
    /**
     * @return string
     */
    public function getOperator()
    {
        return 'cos';
    }

    /**
     * @return int
     */
    public function getPrecedence()
    {
        return self::PRECEDENCE_MEDIUM;
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
        return cos($value2);
    }

    /**
     * @return bool
     */
    public function getStringBrackets()
    {
        return true;
    }
}