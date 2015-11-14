<?php
namespace Calculator\Operator;


use Calculator\Entity;

abstract class Operator extends Entity
{

    /** @internal higher precedence */
    const PRECEDENCE_HIGH = 3;

    /** @internal higher precedence */
    const PRECEDENCE_MEDIUM = 2;

    /** @internal lower precedence */
    const PRECEDENCE_LOW = 1;

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
    public function getType()
    {
        return 'operator';
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getOperator();
    }

}