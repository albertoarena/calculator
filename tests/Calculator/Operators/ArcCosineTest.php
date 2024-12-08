<?php

namespace Tests\Calculator\Operators;

use Calculator\Enums\AngleMeasureEnum;
use Calculator\Exceptions\NotANumberException;
use Calculator\Operators\ArcCosine;
use Calculator\Operators\Operator;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\Models\TestOperator;

class ArcCosineTest extends TestCase
{
    /**
     * @throws NotANumberException
     */
    #[Test]
    public function it_can_calculate_arccosine_using_radians()
    {
        $obj = new ArcCosine;
        $this->assertEquals('acos', $obj->getOperator());
        $this->assertEquals(Operator::PRECEDENCE_MEDIUM, $obj->getPrecedence());
        $this->assertEquals('operator', $obj->getType());
        $this->assertEquals(-1, $obj->getStringOrder());
        $this->assertTrue($obj->getStringBrackets());
        $this->assertEquals('acos', (string) $obj);
        $this->assertTrue($obj->useRadians());
        $this->assertFalse($obj->useDegrees());

        $testValues = [
            // In radians
            new TestOperator(0, -1, M_PI),
            new TestOperator(0, -0.86602540378, 5 * M_PI / 6),
            new TestOperator(0, -0.70710678119, 3 * M_PI / 4),
            new TestOperator(0, -0.5, 2 * M_PI / 3),
            new TestOperator(0, 0, M_PI_2),
            new TestOperator(0, 0.5, M_PI / 3),
            new TestOperator(0, 0.70710678119, M_PI / 4),
            new TestOperator(0, 0.86602540378, M_PI / 6),
            new TestOperator(0, 1, 0),
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

    /**
     * @throws NotANumberException
     */
    #[Test]
    public function it_can_calculate_arccosine_using_degrees()
    {
        $obj = new ArcCosine(measure: AngleMeasureEnum::Degrees);
        $this->assertEquals('acos', $obj->getOperator());
        $this->assertEquals(Operator::PRECEDENCE_MEDIUM, $obj->getPrecedence());
        $this->assertEquals('operator', $obj->getType());
        $this->assertEquals(-1, $obj->getStringOrder());
        $this->assertTrue($obj->getStringBrackets());
        $this->assertEquals('acos', (string) $obj);
        $this->assertFalse($obj->useRadians());
        $this->assertTrue($obj->useDegrees());

        $testValues = [
            // In radians
            new TestOperator(0, -1, 180),
            new TestOperator(0, -0.86602540378, 150),
            new TestOperator(0, -0.70710678119, 135),
            new TestOperator(0, -0.5, 120),
            new TestOperator(0, 0, 90),
            new TestOperator(0, 0.5, 60),
            new TestOperator(0, 0.70710678119, 45),
            new TestOperator(0, 0.86602540378, 30),
            new TestOperator(0, 1, 0),
        ];

        /** @var TestOperator $value */
        foreach ($testValues as $value) {
            $this->assertEqualsWithDelta(
                $value->expected,
                $obj->execute(...$value->values),
                0.000000001
            );
        }
    }

    #[Test]
    public function it_cannot_calculate_arccosine_using_invalid_value()
    {
        $testValues = [-2, 2];
        $obj = new ArcCosine;

        foreach ($testValues as $value) {
            try {
                $obj->execute(0, $value);
                $this->fail();
            } catch (NotANumberException $exception) {
                $this->assertEquals('Not a number (NAN)', $exception->getMessage());
            }
        }
    }
}
