<?php
namespace Calculator\Number;


use Calculator\Entity;
use Calculator\Exception\InvalidNumberException;

class Number extends Entity
{
    /** @var float|int */
    protected $value;

    /**
     * @param float|int $value
     * @throws \Calculator\Exception\InvalidNumberException
     */
    public function __construct($value)
    {
        if (is_int($value) || is_float($value)) {
            $this->value = $value;
        } else {
            throw new InvalidNumberException($value);
        }
    }

    /**
     * @return string
     */
    public function getType()
    {
        return 'number';
    }

    /**
     * @return float|int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->value;
    }
}