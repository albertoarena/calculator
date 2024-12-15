<?php

namespace Tests\Calculator\Operators;

use Calculator\Operators\Add;
use Calculator\Operators\Operator;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\Models\TestOperator;

class AddTest extends TestCase
{
    #[Test]
    public function it_can_sum()
    {
        $obj = new Add;
        $this->assertEquals('+', $obj->getOperator());
        $this->assertEquals(Operator::PRECEDENCE_LOW, $obj->getPrecedence());
        $this->assertEquals('operator', $obj->getType());
        $this->assertEquals(1, $obj->getStringOrder());
        $this->assertFalse($obj->getStringBrackets());
        $this->assertEquals('+', (string) $obj);

        $testValues = [
            new TestOperator(0, 0, 0),
            new TestOperator(1, -1, 0),
            new TestOperator(1, 2, 3),
            new TestOperator(1.2, 2.02, 3.22),
            new TestOperator(1.2, -2.02, -0.82),
            new TestOperator(M_PI, -M_PI, 0),
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