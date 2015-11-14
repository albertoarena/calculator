<?php
namespace Calculator\Number;


class Number
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