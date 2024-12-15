<?php

namespace Tests\Calculator\Operators;

use Calculator\Exceptions\InvalidNumberException;
use Calculator\Operators\Fibonacci;
use Calculator\Operators\Operator;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\Models\TestOperator;

class FibonacciTest extends TestCase
{
    protected function getExpectedNumbers(): array
    {
        // Fibonacci list: see https://planetmath.org/listoffibonaccinumbers
        $ret = [
            0 => 0,
            1 => 1,
            2 => 1,
            3 => 2,
            4 => 3,
            5 => 5,
            6 => 8,
            7 => 13,
            8 => 21,
            9 => 34,
            10 => 55,
            11 => 89,
            12 => 144,
            13 => 233,
            14 => 377,
            15 => 610,
            16 => 987,
            17 => 1597,
            18 => 2584,
            19 => 4181,
            30 => 832040,
            40 => 102334155,
            50 => 12586269025,
            60 => 1548008755920,
            70 => 190392490709135,
            80 => 23416728348467685,
            90 => 2880067194370816120,
            99 => 218922995834555169026,
            100 => 354224848179261915075,
        ];

        return array_map(
            fn ($k, $v) => new TestOperator(0, $k, $v),
            array_keys($ret),
            $ret,
        );
    }

    /**
     * @throws InvalidNumberException
     */
    #[Test]
    public function it_can_calculate_fibonacci_number()
    {
        $obj = new Fibonacci;
        $this->assertEquals('!', $obj->getOperator());
        $this->assertEquals(Operator::PRECEDENCE_HIGH, $obj->getPrecedence());
        $this->assertEquals('operator', $obj->getType());
        $this->assertEquals(1, $obj->getStringOrder());
        $this->assertFalse($obj->getStringBrackets());
        $this->assertEquals('!', (string) $obj);

        $testValues = $this->getExpectedNumbers();
        foreach ($testValues as $value) {
            $this->assertEqualsWithDelta(
                $value->expected,
                $obj->execute(...$value->values),
                0.1E+16
            );
        }
    }

    #[Test]
    public function it_cannot_calculate_fibonacci_number_with_negative_number()
    {
        $this->expectException(InvalidNumberException::class);
        $this->expectExceptionMessage('Invalid number: -5');
        (new Fibonacci)->execute(0, -5);
    }

    #[Test]
    public function it_cannot_calculate_fibonacci_number_with_too_large_number()
    {
        $this->expectException(InvalidNumberException::class);
        $this->expectExceptionMessage('Invalid number: 101');
        (new Fibonacci)->execute(0, 101);
    }
}
