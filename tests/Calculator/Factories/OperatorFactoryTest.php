<?php

namespace Tests\Calculator\Factories;

use Calculator\Exceptions\InvalidOperatorException;
use Calculator\Factories\OperatorFactory;
use Calculator\Operators\Add;
use Calculator\Operators\ArcCosine;
use Calculator\Operators\ArcSine;
use Calculator\Operators\ArcTangent;
use Calculator\Operators\Cosine;
use Calculator\Operators\Divide;
use Calculator\Operators\Fibonacci;
use Calculator\Operators\Multiply;
use Calculator\Operators\Percentage;
use Calculator\Operators\Pow;
use Calculator\Operators\Sine;
use Calculator\Operators\SquareRoot;
use Calculator\Operators\Subtract;
use Calculator\Operators\Tangent;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\Models\TestValue;

class OperatorFactoryTest extends TestCase
{
    /**
     * @throws InvalidOperatorException
     */
    #[Test]
    public function it_can_create_valid_operator()
    {
        $testValues = [
            new TestValue('+', expectedClass: Add::class),
            new TestValue('-', expectedClass: Subtract::class),
            new TestValue('*', expectedClass: Multiply::class),
            new TestValue('/', expectedClass: Divide::class),
            new TestValue('^', expectedClass: Pow::class),
            new TestValue('**', expectedClass: Pow::class),
            new TestValue('√', expectedClass: SquareRoot::class),
            new TestValue('sqrt', expectedClass: SquareRoot::class),
            new TestValue('sin', expectedClass: Sine::class),
            new TestValue('cos', expectedClass: Cosine::class),
            new TestValue('tan', expectedClass: Tangent::class),
            new TestValue('asin', expectedClass: ArcSine::class),
            new TestValue('acos', expectedClass: ArcCosine::class),
            new TestValue('atan', expectedClass: ArcTangent::class),
            new TestValue('!', expectedClass: Fibonacci::class),
            new TestValue('%', expectedClass: Percentage::class),
        ];

        /** @var TestValue $testValue */
        foreach ($testValues as $testValue) {
            $operator = OperatorFactory::createOperator($testValue->value);
            $this->assertInstanceOf($testValue->expectedClass, $operator);
        }
    }

    #[Test]
    public function it_cannot_create_invalid_operator()
    {
        $this->expectException(InvalidOperatorException::class);
        OperatorFactory::createOperator('//');
    }
}
