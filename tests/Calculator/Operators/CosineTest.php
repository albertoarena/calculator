<?php

namespace Tests\Calculator\Operators;

use Calculator\Enums\AngleMeasureEnum;
use Calculator\Operators\Cosine;
use Calculator\Operators\Operator;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\Models\TestOperator;

class CosineTest extends TestCase
{
    #[Test]
    public function it_can_calculate_cosine_using_radians()
    {
        $obj = new Cosine;
        $this->assertEquals('cos', $obj->getOperator());
        $this->assertEquals(Operator::PRECEDENCE_MEDIUM, $obj->getPrecedence());
        $this->assertEquals('operator', $obj->getType());
        $this->assertEquals(-1, $obj->getStringOrder());
        $this->assertTrue($obj->getStringBrackets());
        $this->assertEquals('cos', (string) $obj);

        $testValues = [
            // In radians
            new TestOperator(0, 0, 1),
            new TestOperator(0, M_PI / 6, 0.86602540378),
            new TestOperator(0, M_PI_4, 0.70710678119),
            new TestOperator(0, M_PI / 3, 0.5),
            new TestOperator(0, M_PI_2, 0),

            // In degrees
            new TestOperator(0, deg2rad(30), 0.86602540378),
            new TestOperator(0, deg2rad(45), 0.70710678119),
            new TestOperator(0, deg2rad(60), 0.5),
            new TestOperator(0, deg2rad(90), 0),

            // Other values
            new TestOperator(0, deg2rad(1), 0.99984769516),
            new TestOperator(0, deg2rad(-1), 0.99984769516),
            new TestOperator(0, deg2rad(89), 0.01745240644),
            new TestOperator(0, deg2rad(-89), 0.01745240644),
            new TestOperator(0, M_PI, -1),
            new TestOperator(0, -M_PI, -1),
            new TestOperator(0, -M_PI_2, 0),
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
    public function it_can_calculate_cosine_using_degrees()
    {
        $obj = new Cosine(measure: AngleMeasureEnum::Degrees);
        $this->assertEquals('cos', $obj->getOperator());
        $this->assertEquals(Operator::PRECEDENCE_MEDIUM, $obj->getPrecedence());
        $this->assertEquals('operator', $obj->getType());
        $this->assertEquals(-1, $obj->getStringOrder());
        $this->assertTrue($obj->getStringBrackets());
        $this->assertEquals('cos', (string) $obj);

        $testValues = [
            new TestOperator(0, 0, 57.295779513082),

            // In radians
            new TestOperator(0, rad2deg(M_PI / 6), 49.619600587961),
            new TestOperator(0, rad2deg(M_PI_4), 40.51423422707),
            new TestOperator(0, rad2deg(M_PI / 3), 28.647889756541),
            new TestOperator(0, rad2deg(M_PI_2), 0),

            // In degrees
            new TestOperator(0, 30, 49.619600587961),
            new TestOperator(0, 45, 40.51423422707),
            new TestOperator(0, 60, 28.647889756541),
            new TestOperator(0, 90, 0),

            // Other values
            new TestOperator(0, 1, 57.287053088344),
            new TestOperator(0, -1, 57.287053088344),
            new TestOperator(0, 89, 0.9999492312033),
            new TestOperator(0, -89, 0.9999492312033),
            new TestOperator(0, rad2deg(M_PI), -57.295779513082),
            new TestOperator(0, rad2deg(-M_PI), -57.295779513082),
            new TestOperator(0, rad2deg(-M_PI_2), 0),
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
