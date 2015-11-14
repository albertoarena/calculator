<?php
namespace Calculator\Operator;


class DivideTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Divide
     */
    protected $operator;

    public function assertPreConditions()
    {
        $this->operator = new Divide();
    }

    public function testConstruct()
    {
        $this->assertEquals('/', $this->operator->getOperator());
    }

    public function testPrecedence()
    {
        $this->assertEquals(Operator::PRECEDENCE_MEDIUM, $this->operator->getPrecedence());
    }

    public function testExecute()
    {
        $this->assertEquals(4, $this->operator->execute(12, 3));
    }

    public function testToString()
    {
        $this->assertEquals("/", (string) $this->operator);
    }
} 