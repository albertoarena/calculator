<?php
namespace Calculator\Operator;


class SubtractTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Subtract
     */
    protected $operator;

    public function assertPreConditions()
    {
        $this->operator = new Subtract();
    }

    public function testConstruct()
    {
        $this->assertEquals('-', $this->operator->getOperator());
    }

    public function testPrecedence()
    {
        $this->assertEquals(Operator::PRECEDENCE_LOW, $this->operator->getPrecedence());
    }

    public function testExecute()
    {
        $this->assertEquals(7, $this->operator->execute(10, 3));
    }

    public function testToString()
    {
        $this->assertEquals("-", (string) $this->operator);
    }
} 