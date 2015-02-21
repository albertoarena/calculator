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

    // 1 + 1 * 3 + 3 = 7
    public function testCalculate1()
    {
        $this->calculator->number(1)
            ->operator('+')->number(1)
            ->operator('*')->number(3)
            ->operator('+')->number(3);
        $this->assertEquals(7, $this->calculator->execute());
    }
}