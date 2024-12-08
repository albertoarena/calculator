<?php

namespace Tests\Calculator\Operators;

use Calculator\Exceptions\NotANumberException;
use Calculator\Operators\Operator;
use Calculator\Operators\SquareRoot;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\Models\TestOperator;

class SquareRootTest extends TestCase
{
    /**
     * @throws NotANumberException
     */
    #[Test]
    public function it_can_calculate_square_root()
    {
        $obj = new SquareRoot;
        $this->assertEquals('√', $obj->getOperator());
        $this->assertEquals(Operator::PRECEDENCE_HIGH, $obj->getPrecedence());
        $this->assertEquals('operator', $obj->getType());
        $this->assertEquals(-1, $obj->getStringOrder());
        $this->assertFalse($obj->getStringBrackets());
        $this->assertEquals('√', (string) $obj);

        $testValues = [
            new TestOperator(0, 0, 0),
            new TestOperator(0, 1, 1),
            new TestOperator(0, 9, 3),
            new TestOperator(0, 10, 3.16227766017),
            new TestOperator(0, M_PI, M_SQRTPI),
            new TestOperator(0, 2, M_SQRT2),
            new TestOperator(0, 3, M_SQRT3),
        ];

        foreach ($testValues as $value) {
            $this->assertEqualsWithDelta(
                $value->expected,
                $obj->execute(...$value->values),
                0.00000000001
            );
        }
    }

    #[Test]
    public function it_cannot_calculate_square_root_using_negative_exponent()
    {
        $this->expectException(NotANumberException::class);
        (new SquareRoot)->execute(10, -1);
    }
}
