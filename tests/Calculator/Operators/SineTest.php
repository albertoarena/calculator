<?php

namespace Tests\Calculator\Operators;

use Calculator\Enums\AngleMeasureEnum;
use Calculator\Operators\Operator;
use Calculator\Operators\Sine;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\Models\TestOperator;

class SineTest extends TestCase
{
    #[Test]
    public function it_can_calculate_sine_using_radians()
    {
        $obj = new Sine;
        $this->assertEquals('sin', $obj->getOperator());
        $this->assertEquals(Operator::PRECEDENCE_MEDIUM, $obj->getPrecedence());
        $this->assertEquals('operator', $obj->getType());
        $this->assertEquals(-1, $obj->getStringOrder());
        $this->assertTrue($obj->getStringBrackets());
        $this->assertEquals('sin', (string) $obj);

        $testValues = [
            new TestOperator(0, 0, 0),

            // In radians
            new TestOperator(0, M_PI / 6, 0.5),
            new TestOperator(0, M_PI_4, 0.70710678119),
            new TestOperator(0, M_PI / 3, 0.86602540378),
            new TestOperator(0, M_PI_2, 1),

            // In degrees
            new TestOperator(0, deg2rad(30), 0.5),
            new TestOperator(0, deg2rad(45), 0.70710678119),
            new TestOperator(0, deg2rad(60), 0.86602540378),
            new TestOperator(0, deg2rad(90), 1),

            // Other values
            new TestOperator(0, deg2rad(1), 0.01745240644),
            new TestOperator(0, deg2rad(-1), -0.01745240644),
            new TestOperator(0, deg2rad(89), 0.99984769516),
            new TestOperator(0, deg2rad(-89), -0.99984769516),
            new TestOperator(0, M_PI, 0),
            new TestOperator(0, -M_PI, 0),
            new TestOperator(0, -M_PI_2, -1),
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
    public function it_can_calculate_sine_using_degrees()
    {
        $obj = new Sine(measure: AngleMeasureEnum::Degrees);
        $this->assertEquals('sin', $obj->getOperator());
        $this->assertEquals(Operator::PRECEDENCE_MEDIUM, $obj->getPrecedence());
        $this->assertEquals('operator', $obj->getType());
        $this->assertEquals(-1, $obj->getStringOrder());
        $this->assertTrue($obj->getStringBrackets());
        $this->assertEquals('sin', (string) $obj);

        $testValues = [
            new TestOperator(0, 0, 0),

            // In radians
            new TestOperator(0, rad2deg(M_PI / 6), 28.647889756541),
            new TestOperator(0, rad2deg(M_PI_4), 40.51423422707),
            new TestOperator(0, rad2deg(M_PI / 3), 49.619600587961),
            new TestOperator(0, rad2deg(M_PI_2), 57.295779513082),

            // In degrees
            new TestOperator(0, 30, 28.647889756541),
            new TestOperator(0, 45, 40.51423422707),
            new TestOperator(0, 60, 49.619600587961),
            new TestOperator(0, 90, 57.295779513082),

            // Other values
            new TestOperator(0, 1, 0.9999492312033),
            new TestOperator(0, -1, -0.9999492312033),
            new TestOperator(0, 89, 57.287053088344),
            new TestOperator(0, -89, -57.287053088344),
            new TestOperator(0, rad2deg(M_PI), 0),
            new TestOperator(0, rad2deg(-M_PI), 0),
            new TestOperator(0, rad2deg(-M_PI_2), -57.295779513082),
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
