<?php
namespace Calculator\Operator;


abstract class Operator
{

    /** @internal higher precedence */
    const PRECEDENCE_HIGHER = 2;

    /** @internal lower precedence */
    const PRECEDENCE_LOWER = 1;

    /**
     * @return string
     */
    abstract public function getOperator();

    /**
     * @return int
     */
    abstract public function getPrecedence();

    /**
     * @param float|int $value1
     * @param float|int $value2
     * @return float|int
     */
    abstract public function execute($value1, $value2);

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getOperator();
    }

}