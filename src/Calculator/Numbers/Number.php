<?php

namespace Calculator\Numbers;

use Calculator\Contracts\MathInterface;
use Calculator\Contracts\NumberInterface;
use Calculator\Entity;
use Calculator\Exceptions\InvalidNumberException;
use Calculator\Factories\MathConstantFactory;

class Number extends Entity implements NumberInterface
{
    protected int|float $value;

    protected ?MathConstant $mathConstant;

    /**
     * @throws InvalidNumberException
     */
    public function __construct(
        int|float|string $value,
        protected int $precision = MathInterface::PRECISION,
        protected bool $greekLetters = false,
    ) {
        // Check if math constant
        $this->mathConstant = MathConstantFactory::getAsConstant($value, greekLetters: $greekLetters);
        if ($this->mathConstant) {
            $this->value = $this->mathConstant->value;
        } else {
            // Decode numeric, if possible
            $value = $this->toNumeric($value);
            if (is_numeric($value)) {
                $this->value = $value;
            } else {
                throw new InvalidNumberException($value);
            }
        }
    }

    protected function toNumeric(int|float|string $value): float|int|string|null
    {
        if (is_string($value)) {
            // Check if possibly is a float
            if (str_contains($value, '.')) {
                $isFloat = $value == (string) (float) $value;
                $value = $isFloat ? (float) $value : null;
            } else {
                $isInt = $value == (string) (int) $value;
                $value = $isInt ? (int) $value : null;
            }
        }

        return $value;
    }

    protected function round(): float|int
    {
        return is_int($this->value) ?
            $this->value :
            round($this->value, $this->precision);
    }

    public function getType(): string
    {
        return 'number';
    }

    public function getValue(): float|int
    {
        return $this->value;
    }

    public function __toString()
    {
        return $this->mathConstant->constant ?? (string) $this->round();
    }
}
