<?php

namespace Tests\Calculator\Operators;

use Calculator\Exceptions\DivisionByZeroException;
use Calculator\Operators\Divide;
use Calculator\Operators\Operator;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\Models\TestOperator;

class DivideTest extends TestCase
{
    /**
     * @throws DivisionByZeroException
     */
    #[Test]
    public function it_can_divide()
    {
        $obj = new Divide;
        $this->assertEquals('/', $obj->getOperator());
        $this->assertEquals(Operator::PRECEDENCE_MEDIUM, $obj->getPrecedence());
        $this->assertEquals('operator', $obj->getType());
        $this->assertEquals(1, $obj->getStringOrder());
        $this->assertFalse($obj->getStringBrackets());
        $this->assertEquals('/', (string) $obj);

        $testValues = [
            new TestOperator(0, 1, 0),
            new TestOperator(1, 3, 0.33333333333),
            new TestOperator(3, 1, 3),
            new TestOperator(1.2, 2.02, 0.59405940594),
            new TestOperator(1.2, -2.02, -0.59405940594),
            new TestOperator(M_PI, M_PI, 1),
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
    public function it_cannot_divide_by_zero()
    {
        $this->expectException(DivisionByZeroException::class);
        (new Divide)->execute(10, 0);
    }
}
