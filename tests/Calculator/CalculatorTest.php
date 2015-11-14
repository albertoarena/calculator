<?php
namespace Calculator;


class CalculatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Calculator
     */
    protected $calculator;

    public function assertPreConditions()
    {
        $this->calculator = new Calculator();
    }

    // 1 + 1 * 3 + 3 ==> 7
    public function testCalculateInt1()
    {
        $this->calculator->number(1)
            ->operator('+')->number(1)
            ->operator('*')->number(3)
            ->operator('+')->number(3);
        $this->assertEquals(7, $this->calculator->execute());
    }

    // 5 + 8 / 4 * 3 - 1 ==> 10
    public function testCalculatorInt2()
    {
        $this->calculator->number(5)
            ->operator('+')->number(8)
            ->operator('/')->number(4)
            ->operator('*')->number(3)
            ->operator('-')->number(1);
        $this->assertEquals(10, $this->calculator->execute());
    }

    // 0.5 + 30 / 8 + 3.6 * 1.4 ==> 9.29
    public function testCalculatorFloat1()
    {
        $this->calculator->number(.5)
            ->operator('+')->number(30)
            ->operator('/')->number(8)
            ->operator('+')->number(3.6)
            ->operator('*')->number(1.4);
        $this->assertEquals(9.29, $this->calculator->execute());
    }

    public function testCalculatorPow()
    {
        $this->calculator->number(2)
            ->operator('*')->number(2)
            ->operator('^')->number(4);
        $this->assertEquals(32, $this->calculator->execute());
    }

    public function testCalculatorSquareRoot()
    {
        $this->calculator->number(9)
            ->operator('√');
        $this->assertEquals(3, $this->calculator->execute());
    }

    public function testCalculatorSquareRootAlias()
    {
        $this->calculator->number(9)
            ->operator('sqrt');
        $this->assertEquals(3, $this->calculator->execute());
    }

    public function testCalculatorSine()
    {
        $this->calculator->number(0)
            ->operator('sin');
        $this->assertEquals(0, round($this->calculator->execute(), 5));

        $this->calculator->number(45)
            ->operator('sin');
        $this->assertEquals(0.85090, round($this->calculator->execute(), 5));

        $this->calculator->number(pi() / 2)
            ->operator('sin');
        $this->assertEquals(1, round($this->calculator->execute(), 5));

        $this->calculator->number(90)
            ->operator('sin');
        $this->assertEquals(0.894, round($this->calculator->execute(), 5));

        $this->calculator->number(pi())
            ->operator('sin');
        $this->assertEquals(0, round($this->calculator->execute(), 5));
    }

    public function testCalculatorCosine()
    {
        $this->calculator->number(0)
            ->operator('cos');
        $this->assertEquals(1, $this->calculator->execute());

        $this->calculator->number(45)
            ->operator('cos');
        $this->assertEquals(0.52532, round($this->calculator->execute(), 5));

        $this->calculator->number(pi() / 2)
            ->operator('cos');
        $this->assertEquals(0, round($this->calculator->execute(), 5));

        $this->calculator->number(90)
            ->operator('cos');
        $this->assertEquals(-0.44807, round($this->calculator->execute(), 5));

        $this->calculator->number(pi())
            ->operator('cos');
        $this->assertEquals(-1, round($this->calculator->execute(), 5));
    }

    public function testCalculatorTangent()
    {
        $this->calculator->number(deg2rad(0))
            ->operator('tan');
        $this->assertEquals(0, $this->calculator->execute());

        $this->calculator->number(deg2rad(45))
            ->operator('tan');
        $this->assertEquals(1, round($this->calculator->execute(), 5));
    }

    public function testCalculatorEmpty()
    {
        $this->assertEquals(0, $this->calculator->execute());
    }

    public function testToString()
    {
        $this->calculator->number(1)
            ->operator('+')->number(1)
            ->operator('*')->number(3)
            ->operator('+')->number(3)
            ->execute();
        $this->assertEquals("1 + 1 * 3 + 3 = 7", (string)$this->calculator);
    }

    public function testEmptyToString()
    {
        $this->assertEquals("", (string)$this->calculator);
    }

    public function testToStringWithSquareRoot()
    {
        $this->calculator->number(9)
            ->operator('√')
            ->execute();
        $this->assertEquals("√ 9 = 3", (string)$this->calculator);
    }

    public function testToStringWithTrigonometry()
    {
        $this->calculator
            ->number(1)->operator('sin')
            ->operator('+')->number('1')->operator('cos')
            ->operator('+')->number('1')->operator('tan')
            ->operator('+')->number('1')->operator('asin')
            ->operator('+')->number('1')->operator('acos')
            ->operator('+')->number('1')->operator('atan')
            ->execute();
        $this->assertEquals("sin (1) + cos (1) + tan (1) + asin (1) + acos (1) + atan (1) = 0.78539816339745", (string)$this->calculator);
    }

    public function testToStringWithSquareRootAlias()
    {
        $this->calculator->number(9)
            ->operator('sqrt')
            ->execute();
        $this->assertEquals("√ 9 = 3", (string)$this->calculator);
    }
}