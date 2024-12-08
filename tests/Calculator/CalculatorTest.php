<?php

namespace Tests\Calculator;

use Calculator\Calculator;
use Calculator\Contracts\MathInterface;
use Calculator\Exceptions\InvalidNumberException;
use Calculator\Exceptions\InvalidOperatorException;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    /**
     * @throws InvalidNumberException
     */
    #[Test]
    public function it_can_calculate_with_no_number_or_operator()
    {
        $this->assertEquals(0, (new Calculator)->execute());
    }

    /**
     * @throws InvalidNumberException
     */
    #[Test]
    public function it_can_calculate_with_number_only()
    {
        $this->assertEquals(
            7,
            (new Calculator)
                ->number(7)
                ->execute()
        );
    }

    /**
     * @throws InvalidOperatorException
     * @throws InvalidNumberException
     */
    #[Test]
    public function it_can_calculate_using_integers()
    {
        $this->assertEquals(
            7,
            (new Calculator)
                ->number(1)
                ->operator('+')->number(1)
                ->operator('*')->number(3)
                ->operator('+')->number(3)
                ->execute()
        );
    }

    /**
     * @throws InvalidOperatorException
     * @throws InvalidNumberException
     */
    #[Test]
    public function it_can_calculate_using_integers_and_operators_precedence()
    {
        $this->assertEquals(
            10,
            (new Calculator)
                ->number(5)
                ->operator('+')->number(8)
                ->operator('/')->number(4)
                ->operator('*')->number(3)
                ->operator('-')->number(1)
                ->execute()
        );
    }

    /**
     * @throws InvalidOperatorException
     * @throws InvalidNumberException
     */
    #[Test]
    public function it_can_calculate_using_floats()
    {
        $this->assertEquals(
            9.29,
            (new Calculator)
                ->number(.5)
                ->operator('+')->number(30)
                ->operator('/')->number(8)
                ->operator('+')->number(3.6)
                ->operator('*')->number(1.4)
                ->execute()
        );
    }

    /**
     * @throws InvalidOperatorException
     * @throws InvalidNumberException
     */
    #[Test]
    public function it_can_calculate_using_exponential_expression_and_operators_precedence()
    {
        $this->assertEquals(
            32,
            (new Calculator)
                ->number(2)
                ->operator('*')->number(2)
                ->operator('^')->number(4)
                ->execute()
        );
    }

    /**
     * @throws InvalidOperatorException
     * @throws InvalidNumberException
     */
    #[Test]
    public function it_can_calculate_using_square_root()
    {
        $this->assertEquals(
            3,
            (new Calculator)
                ->number(9)
                ->operator('√')
                ->execute()
        );
    }

    /**
     * @throws InvalidOperatorException
     * @throws InvalidNumberException
     */
    #[Test]
    public function it_can_calculate_using_square_root_alias()
    {
        $this->assertEquals(
            3,
            (new Calculator)
                ->number(9)
                ->operator('sqrt')
                ->execute()
        );
    }

    /**
     * @throws InvalidOperatorException
     * @throws InvalidNumberException
     */
    #[Test]
    public function it_can_calculate_sine()
    {
        $calculator = new Calculator;
        $this->assertEqualsWithDelta(
            0.70710678119,
            $calculator
                ->number(M_PI_4)
                ->operator('sin')
                ->execute(),
            0.00000000001
        );

        $this->assertEquals(
            'sin(0.7853981633974) = 0.7071067811865',
            (string) $calculator
        );
    }

    /**
     * @throws InvalidOperatorException
     * @throws InvalidNumberException
     */
    #[Test]
    public function it_can_calculate_cosine()
    {
        $calculator = new Calculator;
        $this->assertEqualsWithDelta(
            0.70710678119,
            $calculator
                ->number(M_PI_4)
                ->operator('cos')
                ->execute(),
            0.00000000001
        );

        $this->assertEquals(
            'cos(0.7853981633974) = 0.7071067811865',
            (string) $calculator
        );
    }

    /**
     * @throws InvalidOperatorException
     * @throws InvalidNumberException
     */
    #[Test]
    public function it_can_calculate_tangent()
    {
        $calculator = new Calculator;
        $this->assertEqualsWithDelta(
            1,
            $calculator
                ->number(M_PI_4)
                ->operator('tan')
                ->execute(),
            0.00000000001
        );

        $this->assertEquals(
            'tan(0.7853981633974) = 1',
            (string) $calculator
        );
    }

    /**
     * @throws InvalidOperatorException
     * @throws InvalidNumberException
     */
    #[Test]
    public function it_can_calculate_using_negative_operators()
    {
        $this->assertEquals(
            4,
            (new Calculator)
                ->number(2)
                ->operator('+')->number(1)
                ->operator('*')->number(3)->negative()
                ->operator('+')->number(5)
                ->execute()
        );
    }

    #[Test]
    public function it_can_calculate_and_convert_to_string_with_no_number_or_operator()
    {
        $this->assertEquals(
            '',
            (string) new Calculator
        );
    }

    /**
     * @throws InvalidOperatorException
     * @throws InvalidNumberException
     */
    #[Test]
    public function it_can_calculate_and_convert_to_string_using_basic_operators()
    {
        $calculator = new Calculator;
        $calculator->number(1)
            ->operator('+')->number(1)
            ->operator('*')->number(3)
            ->operator('+')->number(3)
            ->execute();

        $this->assertEquals(
            '1 + 1 * 3 + 3 = 7',
            (string) $calculator
        );
    }

    /**
     * @throws InvalidNumberException
     */
    #[Test]
    public function it_can_calculate_and_convert_to_string_with_number_only()
    {
        $calculator = new Calculator;
        $calculator->number(7)
            ->execute();

        $this->assertEquals(
            '7 = 7',
            (string) $calculator
        );
    }

    /**
     * @throws InvalidOperatorException
     * @throws InvalidNumberException
     */
    #[Test]
    public function it_can_calculate_and_convert_to_string_using_negative_operators()
    {
        $calculator = new Calculator;
        $calculator->number(2)
            ->operator('+')->number(1)
            ->operator('*')->number(3)->negative()
            ->operator('+')->number(5)
            ->execute();

        $this->assertEquals(
            '2 + 1 * -3 + 5 = 4',
            (string) $calculator
        );
    }

    /**
     * @throws InvalidOperatorException
     * @throws InvalidNumberException
     */
    #[Test]
    public function it_can_calculate_and_convert_to_string_using_square_root()
    {
        $calculator = new Calculator;
        $calculator->number(9)
            ->operator('√')
            ->execute();

        $this->assertEquals(
            '√9 = 3',
            (string) $calculator
        );
    }

    /**
     * @throws InvalidOperatorException
     * @throws InvalidNumberException
     */
    #[Test]
    public function it_can_calculate_and_convert_to_string_using_square_root_alias()
    {
        $calculator = new Calculator;
        $calculator->number(9)
            ->operator('sqrt')
            ->execute();

        $this->assertEquals(
            '√9 = 3',
            (string) $calculator
        );
    }

    /**
     * @throws InvalidOperatorException
     * @throws InvalidNumberException
     */
    #[Test]
    public function it_can_calculate_and_convert_to_string_using_trigonometric_operators()
    {
        $calculator = new Calculator;
        $calculator->number(1)->operator('sin')
            ->operator('+')
            ->number(1)->operator('cos')
            ->operator('+')
            ->number(1)->operator('tan')
            ->operator('+')
            ->number(1)->operator('asin')
            ->operator('+')
            ->number(1)->operator('acos')
            ->operator('+')
            ->number(1)->operator('atan')
            ->execute();

        $this->assertEquals(MathInterface::PRECISION, $calculator->precision);
        $this->assertEquals(
            'sin(1) + cos(1) + tan(1) + asin(1) + acos(1) + atan(1) = 0.7853981633974',
            (string) $calculator
        );
    }

    /**
     * @throws InvalidOperatorException
     * @throws InvalidNumberException
     */
    #[Test]
    public function it_can_calculate_and_convert_to_string_using_trigonometric_operators_and_custom_precision()
    {
        $calculator = new Calculator(precision: 11);
        $calculator->number(1)->operator('sin')
            ->operator('+')
            ->number(1)->operator('cos')
            ->operator('+')
            ->number(1)->operator('tan')
            ->operator('+')
            ->number(1)->operator('asin')
            ->operator('+')
            ->number(1)->operator('acos')
            ->operator('+')
            ->number(1)->operator('atan')
            ->execute();

        $this->assertEquals(11, $calculator->precision);
        $this->assertEquals(
            'sin(1) + cos(1) + tan(1) + asin(1) + acos(1) + atan(1) = 0.7853981634',
            (string) $calculator
        );
    }
}
