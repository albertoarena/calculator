<?php

namespace Calculator;


abstract class Entity
{
    /**
     * Get type
     *
     * @return string
     */
    abstract public function getType();

    /**
     * Get string order, when the calculation is represented by a string
     * 1: right side (default), -1: left side
     *
     * @return int
     */
    public function getStringOrder()
    {
        return 1;
    }

    /**
     * @return string
     */
    abstract public function __toString();
} 