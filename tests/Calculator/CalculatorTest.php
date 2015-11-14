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

    public function testCalculateEmpty()
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
        $this->assertEquals("1 + 1 * 3 + 3 = 7", (string) $this->calculator);
    }
}