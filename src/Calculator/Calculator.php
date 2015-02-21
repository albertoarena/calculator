<?php
namespace Calculator;


use Calculator\Stack\Stack;

class Calculator
{
    /** @var \Calculator\Stack\Stack */
    protected $output;

    /** @var \Calculator\Stack\Stack */
    protected $operators;

    public function __construct()
    {
        $this->output = new Stack();
        $this->operators = new Stack();
    }

    protected function process($item)
    {
        // @todo
    }

    public function operator($operator)
    {
        $this->process($operator);
        return $this;
    }

    public function number($number)
    {
        $this->process($number);
        return $this;
    }

    public function execute()
    {
        return 0;
    }
}