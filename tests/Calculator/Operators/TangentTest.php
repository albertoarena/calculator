<?php

namespace Tests\Calculator\Operators;

use Calculator\Enums\AngleMeasureEnum;
use Calculator\Exceptions\InfiniteException;
use Calculator\Operators\Operator;
use Calculator\Operators\Tangent;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\Models\TestOperator;

class TangentTest extends TestCase
{
    /**
     * @throws InfiniteException
     */
    #[Test]
    public function it_can_calculate_tangent_using_radians()
    {
        $obj = new Tangent;
        $this->assertEquals('tan', $obj->getOperator());
        $this->assertEquals(Operator::PRECEDENCE_MEDIUM, $obj->getPrecedence());
        $this->assertEquals('operator', $obj->getType());
        $this->assertEquals(-1, $obj->getStringOrder());
        $this->assertTrue($obj->getStringBrackets());
        $this->assertEquals('tan', (string) $obj);

        $testValues = [
            new TestOperator(0, 0, 0),

            // In radians
            new TestOperator(0, M_PI / 12, 2 - sqrt(3)),
            new TestOperator(0, M_PI / 12, 0.2679491924311),
            new TestOperator(0, M_PI / 6, sqrt(3) / 3),
            new TestOperator(0, M_PI / 6, 0.57735026919),
            new TestOperator(0, M_PI_4, 1),
            new TestOperator(0, M_PI / 3, sqrt(3)),
            new TestOperator(0, M_PI / 3, 1.7320508075689),
            new TestOperator(0, M_PI / 12 * 5, 2 + sqrt(3)),
            new TestOperator(0, M_PI / 12 * 5, 3.7320508075689),
            new TestOperator(0, M_PI, 0),
            new TestOperator(0, 2 * M_PI, 0),

            // In degrees
            new TestOperator(0, deg2rad(15), 2 - sqrt(3)),
            new TestOperator(0, deg2rad(15), 0.2679491924311),
            new TestOperator(0, deg2rad(30), sqrt(3) / 3),
            new TestOperator(0, deg2rad(30), 0.57735026919),
            new TestOperator(0, deg2rad(45), 1),
            new TestOperator(0, deg2rad(60), sqrt(3)),
            new TestOperator(0, deg2rad(60), 1.7320508075689),
            new TestOperator(0, deg2rad(75), 2 + sqrt(3)),
            new TestOperator(0, deg2rad(75), 3.7320508075689),
            new TestOperator(0, deg2rad(180), 0),
            new TestOperator(0, deg2rad(360), 0),
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
     * @throws InfiniteException
     */
    #[Test]
    public function it_can_calculate_tangent_using_degrees()
    {
        $obj = new Tangent(measure: AngleMeasureEnum::Degrees);
        $this->assertEquals('tan', $obj->getOperator());
        $this->assertEquals(Operator::PRECEDENCE_MEDIUM, $obj->getPrecedence());
        $this->assertEquals('operator', $obj->getType());
        $this->assertEquals(-1, $obj->getStringOrder());
        $this->assertTrue($obj->getStringBrackets());
        $this->assertEquals('tan', (string) $obj);

        $testValues = [
            new TestOperator(0, 0, 0),

            // In radians
            new TestOperator(0, rad2deg(M_PI / 12), 15.352357850242),
            new TestOperator(0, rad2deg(M_PI / 6), 33.079733725307),
            new TestOperator(0, rad2deg(M_PI_4), 57.295779513082),
            new TestOperator(0, rad2deg(M_PI / 3), 99.239201175923),
            new TestOperator(0, rad2deg(M_PI / 12) * 5, 213.83076020209),
            new TestOperator(0, rad2deg(M_PI), 0),
            new TestOperator(0, rad2deg(2) * M_PI, 0),

            // In degrees
            new TestOperator(0, 15, 15.352357850242),
            new TestOperator(0, 30, 33.079733725307),
            new TestOperator(0, 45, 57.295779513082),
            new TestOperator(0, 60, 99.239201175923),
            new TestOperator(0, 75, 213.83076020209),
            new TestOperator(0, 180, 0),
            new TestOperator(0, 360, 0),
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
    public function it_cannot_calculate_tangent_with_invalid_radians()
    {
        $testValues = [M_PI_2, 3 * M_PI / 2];
        $obj = new Tangent;

        foreach ($testValues as $value) {
            try {
                $obj->execute(0, $value);
                $this->fail();
            } catch (InfiniteException $exception) {
                $this->assertEquals('Result is infinite', $exception->getMessage());
            }
        }
    }

    #[Test]
    public function it_cannot_calculate_tangent_with_invalid_degrees()
    {
        $testValues = [90, 270];
        $obj = new Tangent(measure: AngleMeasureEnum::Degrees);

        foreach ($testValues as $value) {
            try {
                $obj->execute(0, $value);
                $this->fail();
            } catch (InfiniteException $exception) {
                $this->assertEquals('Result is infinite', $exception->getMessage());
            }
        }
    }
}
