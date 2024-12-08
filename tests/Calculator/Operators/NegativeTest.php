<?php

namespace Tests\Calculator\Operators;

use Calculator\Operators\Negative;
use Calculator\Operators\Operator;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\Models\TestOperator;

class NegativeTest extends TestCase
{
    #[Test]
    public function it_can_convert_to_negative()
    {
        $obj = new Negative;
        $this->assertEquals('-', $obj->getOperator());
        $this->assertEquals(Operator::PRECEDENCE_HIGH, $obj->getPrecedence());
        $this->assertEquals('operator', $obj->getType());
        $this->assertEquals(-1, $obj->getStringOrder());
        $this->assertFalse($obj->getStringBrackets());
        $this->assertEquals('-', (string) $obj);

        $testValues = [
            new TestOperator(0, 0, 0),
            new TestOperator(0, -1, 1),
            new TestOperator(0, 1, -1),
            new TestOperator(0, 2.02, -2.02),
            new TestOperator(0, M_PI, -M_PI),
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
