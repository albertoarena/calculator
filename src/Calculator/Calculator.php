<?php

namespace Calculator;

use Calculator\Contracts\MathInterface;
use Calculator\Exceptions\InvalidNumberException;
use Calculator\Exceptions\InvalidOperatorException;
use Calculator\Factories\OperatorFactory;
use Calculator\Numbers\Group;
use Calculator\Numbers\Number;
use Calculator\Numbers\Result;
use Calculator\Operators\Negative;
use Calculator\Operators\Operator;
use Calculator\Stacks\Stack;
use Closure;

/**
 * Class Calculator
 */
class Calculator
{
    public const COMPACT_SPACE_MARKER = '$$$';

    protected Stack $output;

    protected Stack $operators;

    protected Stack $queue;

    public function __construct(
        readonly public int $precision = MathInterface::PRECISION,
        readonly public bool $resultInString = true,
        public bool $greekLetters = false,
    ) {
        $this->output = new Stack;
        $this->operators = new Stack;
        $this->queue = new Stack;
    }

    protected function addToQueue(Number|Operator|Group $item): void
    {
        $this->queue->push($item);
    }

    /**
     * @throws InvalidNumberException
     */
    protected function getNextValue(): Entity|int|float|null
    {
        if (null !== $this->output->current()) {
            return $this->output->pop()->getValue();
        }

        return null;
    }

    /**
     * Process stack
     *
     * @throws InvalidNumberException
     */
    protected function process(Number|Operator|Group $item): void
    {
        $this->addToQueue($item);
        if ($item instanceof Operator) {

            // Get the latest operator in stack
            $lastInStack = $this->operators->current();

            if (! is_null($lastInStack)) {
                // Check precedence
                if ($item->getPrecedence() <= $lastInStack->getPrecedence()) {
                    // Process latest operator in stack
                    $value2 = $this->getNextValue();
                    $value1 = $this->getNextValue();
                    // Push current operator
                    $this->output->push(new Number($lastInStack->execute($value1, $value2)));
                    // Pop last operator
                    $this->operators->pop();
                }
            }
            $this->operators->push($item);
        } else {
            $this->output->push($item);
        }
    }

    /**
     * Finalise process of stack
     *
     * @throws InvalidNumberException
     */
    protected function finaliseProcess(): void
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
     * @throws InvalidOperatorException
     * @throws InvalidNumberException
     */
    public function operator(string $operator): static
    {
        $this->process(OperatorFactory::createOperator($operator));

        return $this;
    }

    /**
     * @throws InvalidNumberException
     */
    public function number(int|float|string $number): static
    {
        $this->process(new Number($number, precision: $this->precision, greekLetters: $this->greekLetters));

        return $this;
    }

    /**
     * @throws InvalidNumberException
     */
    public function negative(): static
    {
        $this->process(new Negative);

        return $this;
    }

    /**
     * @throws InvalidNumberException
     */
    public function group(Closure $closure): static
    {
        $this->process(new Group(
            closure: $closure,
            precision: $this->precision,
            greekLetters: $this->greekLetters
        ));

        return $this;
    }

    /**
     * Execute calculation
     *
     * @throws InvalidNumberException
     */
    public function execute(): float|int
    {
        $this->finaliseProcess();

        $result = 0;
        if ($this->output->count()) {
            $result = $this->output->pop()->getValue();

            // Total added to queue
            $this->queue->push(new Result(value: $result, precision: $this->precision));
        }

        return $result;
    }

    public function __toString()
    {
        // Normalise operators with inverted string order
        $queue = [];
        while ($this->queue->count()) {
            $item = $this->queue->shift();
            $queue[] = $item;
            $index = count($queue) - 1;
            if ($item->getStringOrder() < 0 && $index > 0) {
                // swap with previous item
                $v = $queue[$index - 1];
                $queue[$index - 1] = $item;

                if ($item->getStringBrackets()) {
                    $queue[$index] = "($v)";
                } else {
                    $queue[$index] = $v;
                }
                $queue = array_merge(
                    array_slice($queue, 0, $index),
                    [self::COMPACT_SPACE_MARKER],
                    array_slice($queue, $index)
                );
            }
        }

        if (! $this->resultInString) {
            $queue = array_filter($queue, function ($item) {
                return ! $item instanceof Result;
            });
        }

        // Normalise spaces
        $ret = str_replace(' '.self::COMPACT_SPACE_MARKER.' ', '', implode(' ', $queue));

        // Normalise double parentheses
        $ret = str_replace(['((', '))'], ['(', ')'], $ret);

        // Normalise Fibonacci number and percentage
        $ret = str_replace([' ! ', ' % '], ['! ', '% '], $ret);

        $this->queue->reset();

        return $ret;
    }
}
