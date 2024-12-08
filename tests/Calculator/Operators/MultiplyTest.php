<?php

namespace Tests\Calculator\Operators;

use Calculator\Operators\Multiply;
use Calculator\Operators\Operator;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\Models\TestOperator;

class MultiplyTest extends TestCase
{
    #[Test]
    public function it_can_multiply()
    {
        $obj = new Multiply;
        $this->assertEquals('*', $obj->getOperator());
        $this->assertEquals(Operator::PRECEDENCE_MEDIUM, $obj->getPrecedence());
        $this->assertEquals('operator', $obj->getType());
        $this->assertEquals(1, $obj->getStringOrder());
        $this->assertFalse($obj->getStringBrackets());
        $this->assertEquals('*', (string) $obj);

        $testValues = [
            new TestOperator(0, 0, 0),
            new TestOperator(1, 0, 0),
            new TestOperator(1, 3, 3),
            new TestOperator(1.2, 2.02, 2.424),
            new TestOperator(1.2, -2.02, -2.424),
            new TestOperator(M_PI, M_PI, 9.86960440109),
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
}
