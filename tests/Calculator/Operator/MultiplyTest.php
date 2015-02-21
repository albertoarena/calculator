<?php
namespace Calculator\Operator;


class MultiplyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Multiply
     */
    protected $operator;

    public function assertPreConditions()
    {
        $this->operator = new Multiply();
    }

    public function testConstruct()
    {
        $this->assertEquals('*', $this->operator->getOperator());
    }

    public function testPrecedence()
    {
        $this->assertEquals(Operator::PRECEDENCE_HIGHER, $this->operator->getPrecedence());
    }

    public function testExecute()
    {
        $this->assertEquals(10, $this->operator->execute(5, 2));
    }
} 