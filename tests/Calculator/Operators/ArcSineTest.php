<?php

namespace Tests\Calculator\Operators;

use Calculator\Enums\AngleMeasureEnum;
use Calculator\Exceptions\NotANumberException;
use Calculator\Operators\ArcSine;
use Calculator\Operators\Operator;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\Models\TestOperator;

class ArcSineTest extends TestCase
{
    #[Test]
    public function it_can_calculate_arcsine_using_radians()
    {
        $obj = new ArcSine;
        $this->assertEquals('asin', $obj->getOperator());
        $this->assertEquals(Operator::PRECEDENCE_MEDIUM, $obj->getPrecedence());
        $this->assertEquals('operator', $obj->getType());
        $this->assertEquals(-1, $obj->getStringOrder());
        $this->assertTrue($obj->getStringBrackets());
        $this->assertEquals('asin', (string) $obj);
        $this->assertTrue($obj->useRadians());
        $this->assertFalse($obj->useDegrees());

        $testValues = [
            // Range: -1 to 1
            new TestOperator(0, -1, -M_PI_2),
            new TestOperator(0, -0.86602540378, -M_PI / 3),
            new TestOperator(0, -0.70710678119, -M_PI_4),
            new TestOperator(0, -0.5, -M_PI / 6),
            new TestOperator(0, 0, 0),
            new TestOperator(0, 0.5, M_PI / 6),
            new TestOperator(0, 0.70710678119, M_PI_4),
            new TestOperator(0, 0.86602540378, M_PI / 3),
            new TestOperator(0, 1, M_PI_2),
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

    /**
     * @throws NotANumberException
     */
    #[Test]
    public function it_can_calculate_arcsine_using_degrees()
    {
        $obj = new ArcSine(measure: AngleMeasureEnum::Degrees);
        $this->assertEquals('asin', $obj->getOperator());
        $this->assertEquals(Operator::PRECEDENCE_MEDIUM, $obj->getPrecedence());
        $this->assertEquals('operator', $obj->getType());
        $this->assertEquals(-1, $obj->getStringOrder());
        $this->assertTrue($obj->getStringBrackets());
        $this->assertEquals('asin', (string) $obj);
        $this->assertFalse($obj->useRadians());
        $this->assertTrue($obj->useDegrees());

        $testValues = [
            // Range: -90 to 90
            new TestOperator(0, -1, -90),
            new TestOperator(0, -0.86602540378, -60),
            new TestOperator(0, -0.70710678119, -45),
            new TestOperator(0, -0.5, -30),
            new TestOperator(0, 0, 0),
            new TestOperator(0, 0.5, 30),
            new TestOperator(0, 0.70710678119, 45),
            new TestOperator(0, 0.86602540378, 60),
            new TestOperator(0, 1, 90),
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

    #[Test]
    public function it_cannot_calculate_arcsine_using_invalid_value()
    {
        $testValues = [-2, 2];
        $obj = new ArcSine;

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
