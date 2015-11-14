<?php
namespace Calculator;


use Calculator\Number\Number;
use Calculator\Number\Result;
use Calculator\Operator\Operator;
use Calculator\Stack\Stack;

/**
 * Class Calculator
 * @package Calculator
 *
 * The logic is inspired by shunting-yard algorithm
 * http://en.wikipedia.org/wiki/Shunting-yard_algorithm
 */
class Calculator
{
    /** @var \Calculator\Stack\Stack */
    protected $output;

    /** @var \Calculator\Stack\Stack */
    protected $operators;

    /** @var \Calculator\Stack\Stack */
    protected $queue;

    public function __construct()
    {
        $this->output = new Stack();
        $this->operators = new Stack();
        $this->queue = new Stack();
    }

    /**
     * @param Entity $item
     */
    protected function addToQueue($item)
    {
        if ($item instanceof Entity) {
            $this->queue->push($item);
        }
    }

    /**
     * @return Entity|null
     */
    protected function getNextValue()
    {
        if ($this->output->current() !== null) {
            return $this->output->pop()->getValue();
        }
        return null;
    }

    /**
     * Process stack
     *
     * @param Entity $item
     */
    protected function process($item)
    {
        $this->addToQueue($item);
        if ($item instanceof Operator) {

            // Get the latest operator in stack
            $lastInStack = $this->operators->current();

            if (!is_null($lastInStack)) {

                // Check precedence
                if ($item->getPrecedence() > $lastInStack->getPrecedence()) {
                    // Push current operator
                    $this->operators->push($item);
                } else {
                    // Process latest operator in stack
                    $value2 = $this->getNextValue();
                    $value1 = $this->getNextValue();
                    $this->output->push(new Number($lastInStack->execute($value1, $value2)));
                    // Pop last operator
                    $this->operators->pop();
                    // Push current operator
                    $this->operators->push($item);
                }
            } else {
                // Empty stack, push current operator
                $this->operators->push($item);
            }
        } else if ($item instanceof Number) {
            $this->output->push($item);
        }
    }

    /**
     * Finalise process of stack
     */
    protected function finaliseProcess()
    {
        // Reduce operators in stack
        while ($this->operators->count()) {
            // Process latest operator in stack
            $value2 = $this->getNextValue();
            $value1 = $this->getNextValue();
            $this->output->push(new Number($this->operators->pop()->execute($value1, $value2)));
        }
    }

    /**
     * @param string $operator
     * @return $this
     */
    public function operator($operator)
    {
        $this->process(OperatorFactory::createOperator($operator));
        return $this;
    }

    /**
     * @param int|float $number
     * @return $this
     */
    public function number($number)
    {
        $this->process(new Number($number));
        return $this;
    }

    /**
     * Execute calculation
     * @return int|float
     */
    public function execute()
    {
        $this->finaliseProcess();

        $result = 0;
        if ($this->output->count()) {
            $result = $this->output->pop()->getValue();

            // Total added to queue
            $this->queue->push(new Result($result));
        }

        return $result;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        // Normalise operators with inverted string order
        $queue = array();
        while ($this->queue->count()) {
            $item = $this->queue->shift();
            $queue[] = $item;
            $index = count($queue) - 1;
            if (is_object($item) && $item->getStringOrder() < 0 && $index > 0) {
                // swap with previous item
                $v = $queue[$index - 1];
                $queue[$index - 1] = $item;

                if ($item->getStringBrackets()) {
                    $queue[$index] = '(' . $v . ')';
                } else {
                    $queue[$index] = $v;
                }
            }
        }

        $ret = implode(' ', $queue);
        $this->queue->reset();
        return $ret;
    }
}