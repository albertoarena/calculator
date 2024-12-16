<?php

namespace Tests\Calculator\Factories;

use Calculator\Concerns\HasPhi;
use Calculator\Factories\MathConstantFactory;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\Models\TestValue;

class MathConstantFactoryTest extends TestCase
{
    use HasPhi;

    #[Test]
    public function it_can_create_math_constants_from_factory()
    {
        $testValues = [
            new TestValue('pi', 'pi', M_PI),
            new TestValue('π', 'pi', M_PI),
            new TestValue('e', 'e', M_E),
            new TestValue('phi', 'phi', self::getPhi()),
            new TestValue('φ', 'phi', self::getPhi()),
        ];

        /** @var TestValue $testValue */
        foreach ($testValues as $testValue) {
            $constant = MathConstantFactory::getAsConstant($testValue->value);
            $this->assertNotNull($constant);
            $this->assertEquals($testValue->expected, $constant->constant);
            $this->assertEquals($testValue->expectedValue, $constant->value);
            $this->assertFalse($constant->greekLetters);
        }
    }

    #[Test]
    public function it_can_create_math_constants_from_factory_using_greek_letters()
    {
        $testValues = [
            new TestValue('pi', 'π', M_PI),
            new TestValue('π', 'π', M_PI),
            new TestValue('e', 'e', M_E),
            new TestValue('phi', 'φ', self::getPhi()),
            new TestValue('φ', 'φ', self::getPhi()),
        ];

        /** @var TestValue $testValue */
        foreach ($testValues as $testValue) {
            $constant = MathConstantFactory::getAsConstant($testValue->value, greekLetters: true);
            $this->assertNotNull($constant);
            $this->assertEquals($testValue->expected, $constant->constant);
            $this->assertEquals($testValue->expectedValue, $constant->value);
            $this->assertTrue($constant->greekLetters);
        }
    }

    #[Test]
    public function it_cannot_create_invalid_or_unsupported_math_constants()
    {
        $testValues = [
            new TestValue('i'), // Imaginary unit
            new TestValue('γ'), // Euler–Mascheroni constant
            new TestValue('hello_world'),
            new TestValue(123),
            new TestValue(1.23),
            new TestValue('123'),
        ];

        /** @var TestValue $testValue */
        foreach ($testValues as $testValue) {
            $constant = MathConstantFactory::getAsConstant($testValue->value, greekLetters: true);
            $this->assertNull($constant);
        }
    }
}
