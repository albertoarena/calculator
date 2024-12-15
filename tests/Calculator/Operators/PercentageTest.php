<?php

namespace Tests\Calculator\Operators;

use Calculator\Operators\Operator;
use Calculator\Operators\Percentage;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\Models\TestOperator;

class PercentageTest extends TestCase
{
    #[Test]
    public function it_can_calculate_percentage()
    {
        $obj = new Percentage;
        $this->assertEquals('%', $obj->getOperator());
        $this->assertEquals(Operator::PRECEDENCE_HIGH, $obj->getPrecedence());
        $this->assertEquals('operator', $obj->getType());
        $this->assertEquals(1, $obj->getStringOrder());
        $this->assertFalse($obj->getStringBrackets());
        $this->assertEquals('%', (string) $obj);

        $testValues = [
            new TestOperator(0, 0, 0),
            new TestOperator(0, 3.221, 0.03221),
            new TestOperator(0, 10, .10),
            new TestOperator(0, 99, .99),
            new TestOperator(0, 101, 1.01),
        ];
        foreach ($testValues as $value) {
            $this->assertEquals(
                $value->expected,
                $obj->execute(...$value->values),
            );
        }
    }
}
