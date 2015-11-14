<?php
namespace Calculator\Number;


use Calculator\Entity;

class Number extends Entity
{
    /** @var float|int */
    protected $value;

    /**
     * @param float|int $value
     */
    public function __construct($value)
    {
        $this->value = $value;
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
        return (string) $this->value;
    }
}