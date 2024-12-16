<?php

namespace Calculator\Numbers;

use Calculator\Calculator;
use Calculator\Contracts\MathInterface;
use Calculator\Contracts\NumberInterface;
use Calculator\Entity;
use Calculator\Exceptions\InvalidNumberException;
use Closure;

class Group extends Entity implements NumberInterface
{
    protected Calculator $calculator;

    public function __construct(
        protected Closure $closure,
        protected int $precision = MathInterface::PRECISION,
        protected bool $greekLetters = false,
    ) {
        $this->calculator = new Calculator(
            precision: $this->precision,
            resultInString: false,
            greekLetters: $this->greekLetters
        );
    }

    public function getType(): string
    {
        return 'group';
    }

    public function __toString()
    {
        return '('.$this->calculator.')';
    }

    /**
     * @throws InvalidNumberException
     */
    public function getValue(): float|int
    {
        return $this->process();
    }

    /**
     * @throws InvalidNumberException
     */
    public function process(): float|int
    {
        $this->closure->__invoke($this->calculator);

        return $this->calculator->execute();
    }
}
