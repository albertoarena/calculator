<?php
namespace Calculator\Stack;


class Stack
{
    /** @var array */
    protected $stack;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->stack = array();
    }

    /**
     * @param mixed $item
     */
    public function push($item)
    {
        array_push($this->stack, $item);
    }

    /**
     * @return mixed
     */
    public function pop()
    {
        return array_pop($this->stack);
    }

    /**
     * @param mixed $item
     */
    public function prepend($item)
    {
        array_unshift($this->stack, $item);
    }

    /**
     * @return mixed
     */
    public function shift()
    {
        return array_shift($this->stack);
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->stack);
    }

    /**
     *
     */
    public function reset()
    {
        $this->stack = array();
    }

    /**
     * @return mixed|null
     */
    public function current()
    {
        if ($c = count($this->stack)) {
            return $this->stack[$c - 1];
        }
        return null;
    }

} 