<?php
namespace Calculator;


use Calculator\Number\Number;
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

    /** @var array */
    protected $asString;

    public function __construct()
    {
        $this->output = new Stack();
        $this->operators = new Stack();
        $this->asString = array();
    }

    /**
     * @param $item
     */
    protected function process($item)
    {
        if ($item instanceof Operator) {
            $this->asString[] = $item;

            // Get the latest operator in stack
            $lastInStack = $this->operators->current();

            if (!is_null($lastInStack)) {

                // Check precedence
                if ($item->getPrecedence() > $lastInStack->getPrecedence()) {
                    // Push current operator
                    $this->operators->push($item);
                } else {
                    // Process latest operator in stack
                    $value2 = $this->output->pop()->getValue();
                    $value1 = $this->output->pop()->getValue();
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
            $this->asString[] = $item;
            $this->output->push($item);
        }
    }

    protected function finaliseProcess()
    {
        // Reduce operators in stack
        while ($this->operators->count()) {
            $value2 = $this->output->pop()->getValue();
            $value1 = $this->output->pop()->getValue();
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
        }

        $this->asString[] = '=';
        $this->asString[] = $result;

        return $result;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $ret = implode(' ', $this->asString);
        $this->asString = array();
        return $ret;
    }
}