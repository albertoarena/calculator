<?php
namespace Calculator\Operator;


class PowTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Pow
     */
    protected $operator;

    public function assertPreConditions()
    {
        $this->operator = new Pow();
    }

    public function testConstruct()
    {
        $this->assertEquals('^', $this->operator->getOperator());
    }

    public function testPrecedence()
    {
        $this->assertEquals(Operator::PRECEDENCE_HIGH, $this->operator->getPrecedence());
    }

    public function testExecute()
    {
        $this->assertEquals(8, $this->operator->execute(2, 3));
    }

    public function testToString()
    {
        $this->assertEquals("^", (string) $this->operator);
    }

    public function testGetType()
    {
        $this->assertEquals('operator', $this->operator->getType());
    }

    public function testGetStringOrder()
    {
        $this->assertEquals(1, $this->operator->getStringOrder());
    }
} 