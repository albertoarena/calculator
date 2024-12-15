<?php

namespace Tests\Calculator\Numbers;

use Calculator\Exceptions\InvalidNumberException;
use Calculator\Numbers\Number;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\Models\TestValue;
use TypeError;

class NumberTest extends TestCase
{
    /**
     * @throws InvalidNumberException
     */
    #[Test]
    public function it_can_create_a_valid_number()
    {
        $testValues = [
            new TestValue(0, '0'),
            new TestValue(0.0, '0'),
            new TestValue(0.0000000000001, '1.0E-13'), // Rendered as 1.0E-13
            new TestValue(1.0E-13, '1.0E-13'),
            new TestValue(1.0E-14, '0'),
            new TestValue(456, '456'),
            new TestValue(4.56, '4.56'),
            new TestValue(-456, '-456'),
            new TestValue(-4.56, '-4.56'),
            new TestValue(M_E, '2.7182818284591'),
            new TestValue(M_PI, '3.1415926535898'),
            new TestValue('0', '0'),
            new TestValue('0.0', '0'),
            new TestValue('0.0000000000001', '1.0E-13'), // Rendered as 1.0E-13
            new TestValue('0.00000000000001', '0'), // Rendered as 0 --> it exceeds default precision 14
            new TestValue('1.0E-13', '1.0E-13'),
            new TestValue('1.0E-14', '0'), // Rendered as 0 --> it exceeds default precision 14
            new TestValue('456', '456'),
            new TestValue('4.56', '4.56'),
            new TestValue('-456', '-456'),
            new TestValue('-4.56', '-4.56'),
            new TestValue((string) M_E, '2.718281828459'), // Note: this is different compared to float M_E
            new TestValue((string) M_PI, '3.1415926535898'),
        ];

        /** @var TestValue $value */
        foreach ($testValues as $value) {
            $number = new Number($value->value);
            $this->assertEquals($value->value, $number->getValue());
            $this->assertEquals('number', $number->getType());
            $this->assertEquals($value->expected, (string) $number);
            $this->assertEquals(1, $number->getStringOrder());
            $this->assertFalse($number->getStringBrackets());
        }
    }

    /**
     * @throws InvalidNumberException
     */
    #[Test]
    public function it_can_create_a_valid_number_with_custom_precision()
    {
        $testValues = [
            new TestValue(0.0000000001, '1.0E-10'), // Rendered as 1.0E-10
            new TestValue(0.00000000000001, '0'), // Rendered as 0 --> it exceeds precision 11
            new TestValue(1.0E-10, '1.0E-10'),
            new TestValue(1.0E-14, '0'), // Rendered as 0 --> it exceeds precision 11
            new TestValue(M_E, '2.7182818285'),
            new TestValue(M_PI, '3.1415926536'),
            new TestValue('0.0000000001', '1.0E-10'), // Rendered as 1.0E-10
            new TestValue('0.00000000000001', '0'), // Rendered as 0 --> it exceeds precision 11
            new TestValue('1.0E-10', '1.0E-10'),
            new TestValue('1.0E-14', '0'), // Rendered as 0 --> it exceeds precision 11
            new TestValue((string) M_E, '2.7182818285'),
            new TestValue((string) M_PI, '3.1415926536'),
        ];

        /** @var TestValue $value */
        foreach ($testValues as $value) {
            $number = new Number($value->value, precision: 10);
            $this->assertEquals($value->value, $number->getValue());
            $this->assertEquals('number', $number->getType());
            $this->assertEquals($value->expected, (string) $number);
            $this->assertEquals(1, $number->getStringOrder());
            $this->assertFalse($number->getStringBrackets());
        }
    }

    #[Test]
    public function it_cannot_create_a_number_with_an_invalid_value()
    {
        $this->expectException(InvalidNumberException::class);
        new Number('abc');
    }

    /**
     * @throws InvalidNumberException
     */
    #[Test]
    public function it_cannot_create_a_number_with_an_invalid_type()
    {
        $this->expectException(TypeError::class);
        // @phpstan-ignore argument.type
        new Number((object) 1.23);
    }
}
