<?php
namespace Calculator\Operator;


class PowTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Add
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
} 