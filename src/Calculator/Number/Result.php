<?php
namespace Calculator\Number;


class Result extends Number
{
    /**
     * @return string
     */
    public function getType()
    {
        return 'result';
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return '= ' . (string) $this->value;
    }
} 