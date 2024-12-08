<?php

namespace Tests\Calculator\Operators;

use Calculator\Exceptions\DivisionByZeroException;
use Calculator\Operators\Operator;
use Calculator\Operators\Pow;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\Models\TestOperator;

class PowTest extends TestCase
{
    /**
     * @throws DivisionByZeroException
     */
    #[Test]
    public function it_can_calculate_power()
    {
        $obj = new Pow;
        $this->assertEquals('^', $obj->getOperator());
        $this->assertEquals(Operator::PRECEDENCE_HIGH, $obj->getPrecedence());
        $this->assertEquals('operator', $obj->getType());
        $this->assertEquals(1, $obj->getStringOrder());
        $this->assertFalse($obj->getStringBrackets());
        $this->assertEquals('^', (string) $obj);

        $testValues = [
            new TestOperator(0, 0, 1),
            new TestOperator(0, 1, 0),
            new TestOperator(3, 0, 1),
            new TestOperator(3, 1, 3),
            new TestOperator(3, 2, 9),
            new TestOperator(-1, 20, 1),
            new TestOperator(3.234, .987, 3.18502903216),
        ];

        /** @var TestOperator $value */
        foreach ($testValues as $value) {
            $this->assertEqualsWithDelta(
                $value->expected,
                $obj->execute(...$value->values),
                0.00000000001
            );
        }
    }

    #[Test]
    public function it_cannot_calculate_power_using_negative_exponent()
    {
        $this->expectException(DivisionByZeroException::class);
        (new Pow)->execute(10, -1);
    }
}
