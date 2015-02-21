<?php
namespace Calculator\Operator;


class AddTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Add
     */
    protected $operator;

    public function assertPreConditions()
    {
        $this->operator = new Add();
    }

    public function testConstruct()
    {
        $this->assertEquals('+', $this->operator->getOperator());
    }

    public function testPrecedence()
    {
        $this->assertEquals(Operator::PRECEDENCE_LOWER, $this->operator->getPrecedence());
    }

    public function testExecute()
    {
        $this->assertEquals(5, $this->operator->execute(2, 3));
    }
} 