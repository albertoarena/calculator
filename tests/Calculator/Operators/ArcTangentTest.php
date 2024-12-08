<?php

namespace Tests\Calculator\Operators;

use Calculator\Enums\AngleMeasureEnum;
use Calculator\Operators\ArcTangent;
use Calculator\Operators\Operator;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\Models\TestOperator;

class ArcTangentTest extends TestCase
{
    #[Test]
    public function it_can_calculate_arctangent_using_radians()
    {
        $obj = new ArcTangent;
        $this->assertEquals('atan', $obj->getOperator());
        $this->assertEquals(Operator::PRECEDENCE_MEDIUM, $obj->getPrecedence());
        $this->assertEquals('operator', $obj->getType());
        $this->assertEquals(-1, $obj->getStringOrder());
        $this->assertTrue($obj->getStringBrackets());
        $this->assertEquals('atan', (string) $obj);
        $this->assertTrue($obj->useRadians());
        $this->assertFalse($obj->useDegrees());
        $testValues = [
            // In negative radians
            new TestOperator(0, -INF, -M_PI_2),
            new TestOperator(0, -(2 + sqrt(3)), -M_PI / 12 * 5),
            new TestOperator(0, -3.7320508075689, -M_PI / 12 * 5),
            new TestOperator(0, -1.7320508075689, -M_PI / 3),
            new TestOperator(0, -sqrt(3), -M_PI / 3),
            new TestOperator(0, -1, -M_PI_4),
            new TestOperator(0, -sqrt(3) / 3, -M_PI / 6),
            new TestOperator(0, -0.57735026919, -M_PI / 6),
            new TestOperator(0, -(2 - sqrt(3)), -M_PI / 12),
            new TestOperator(0, -0.2679491924311, -M_PI / 12),

            // In radians
            new TestOperator(0, 0, 0),
            new TestOperator(0, 2 - sqrt(3), M_PI / 12),
            new TestOperator(0, 0.2679491924311, M_PI / 12),
            new TestOperator(0, sqrt(3) / 3, M_PI / 6),
            new TestOperator(0, 0.57735026919, M_PI / 6),
            new TestOperator(0, 1, M_PI_4),
            new TestOperator(0, sqrt(3), M_PI / 3),
            new TestOperator(0, 1.7320508075689, M_PI / 3),
            new TestOperator(0, 2 + sqrt(3), M_PI / 12 * 5),
            new TestOperator(0, 3.7320508075689, M_PI / 12 * 5),
            new TestOperator(0, INF, M_PI_2),

            // In negative degrees
            new TestOperator(0, -INF, -deg2rad(90)),
            new TestOperator(0, -(2 + sqrt(3)), -deg2rad(75)),
            new TestOperator(0, -3.7320508075689, -deg2rad(75)),
            new TestOperator(0, -1.7320508075689, -deg2rad(60)),
            new TestOperator(0, -sqrt(3), -deg2rad(60)),
            new TestOperator(0, -1, -deg2rad(45)),
            new TestOperator(0, -sqrt(3) / 3, -deg2rad(30)),
            new TestOperator(0, -0.57735026919, -deg2rad(30)),
            new TestOperator(0, -(2 - sqrt(3)), -deg2rad(15)),
            new TestOperator(0, -0.2679491924311, -deg2rad(15)),
            new TestOperator(0, 0, 0),

            // In degrees
            new TestOperator(0, 2 - sqrt(3), deg2rad(15)),
            new TestOperator(0, 0.2679491924311, deg2rad(15)),
            new TestOperator(0, sqrt(3) / 3, deg2rad(30)),
            new TestOperator(0, 0.57735026919, deg2rad(30)),
            new TestOperator(0, 1, deg2rad(45)),
            new TestOperator(0, sqrt(3), deg2rad(60)),
            new TestOperator(0, 1.7320508075689, deg2rad(60)),
            new TestOperator(0, 2 + sqrt(3), deg2rad(75)),
            new TestOperator(0, 3.7320508075689, deg2rad(75)),
            new TestOperator(0, INF, deg2rad(90)),
        ];

        /** @var TestOperator $value */
        foreach ($testValues as $value) {
            if (is_nan($value->expected)) {
                $this->assertNan($obj->execute(...$value->values));
            } else {
                $this->assertEqualsWithDelta(
                    $value->expected,
                    $obj->execute(...$value->values),
                    0.00000000001
                );
            }
        }
    }

    #[Test]
    public function it_can_calculate_arctangent_using_degrees()
    {
        $obj = new ArcTangent(measure: AngleMeasureEnum::Degrees);
        $this->assertEquals('atan', $obj->getOperator());
        $this->assertEquals(Operator::PRECEDENCE_MEDIUM, $obj->getPrecedence());
        $this->assertEquals('operator', $obj->getType());
        $this->assertEquals(-1, $obj->getStringOrder());
        $this->assertTrue($obj->getStringBrackets());
        $this->assertEquals('atan', (string) $obj);
        $this->assertFalse($obj->useRadians());
        $this->assertTrue($obj->useDegrees());

        $testValues = [
            // In negative degrees
            new TestOperator(0, -INF, -90),
            new TestOperator(0, -(2 + sqrt(3)), -75),
            new TestOperator(0, -3.7320508075689, -75),
            new TestOperator(0, -1.7320508075689, -60),
            new TestOperator(0, -sqrt(3), -60),
            new TestOperator(0, -1, -45),
            new TestOperator(0, -sqrt(3) / 3, -30),
            new TestOperator(0, -0.57735026919, -30),
            new TestOperator(0, -(2 - sqrt(3)), -15),
            new TestOperator(0, -0.2679491924311, -15),
            new TestOperator(0, 0, 0),

            // In degrees
            new TestOperator(0, 2 - sqrt(3), 15),
            new TestOperator(0, 0.2679491924311, 15),
            new TestOperator(0, sqrt(3) / 3, 30),
            new TestOperator(0, 0.57735026919, 30),
            new TestOperator(0, 1, 45),
            new TestOperator(0, sqrt(3), 60),
            new TestOperator(0, 1.7320508075689, 60),
            new TestOperator(0, 2 + sqrt(3), 75),
            new TestOperator(0, 3.7320508075689, 75),
            new TestOperator(0, INF, 90),
        ];

        /** @var TestOperator $value */
        foreach ($testValues as $value) {
            if (is_nan($value->expected)) {
                $this->assertNan($obj->execute(...$value->values));
            } else {
                $this->assertEqualsWithDelta(
                    $value->expected,
                    $obj->execute(...$value->values),
                    0.000000001
                );
            }
        }
    }
}
