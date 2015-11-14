<?php
namespace Calculator\Operator;


class SquareRootTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SquareRoot
     */
    protected $operator;

    public function assertPreConditions()
    {
        $this->operator = new SquareRoot();
    }

    public function testConstruct()
    {
        $this->assertEquals('√', $this->operator->getOperator());
    }

    public function testPrecedence()
    {
        $this->assertEquals(Operator::PRECEDENCE_HIGH, $this->operator->getPrecedence());
    }

    public function testExecute()
    {
        $this->assertEquals(3, $this->operator->execute(null, 9));
        $this->assertEquals(3, $this->operator->execute(0, 9));
        $this->assertEquals(3, $this->operator->execute(1000, 9));
        $this->assertEquals(0, $this->operator->execute(0, 0));
    }

    public function testToString()
    {
        $this->assertEquals("√", (string) $this->operator);
    }

    public function testGetType()
    {
        $this->assertEquals('operator', $this->operator->getType());
    }
} 