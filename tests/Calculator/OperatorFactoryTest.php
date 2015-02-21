<?php
namespace Calculator;


class OperatorFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $operator = OperatorFactory::createOperator('+');
        $this->assertInstanceOf('Calculator\Operator\Add', $operator);

        $operator = OperatorFactory::createOperator('-');
        $this->assertInstanceOf('Calculator\Operator\Subtract', $operator);

        $operator = OperatorFactory::createOperator('*');
        $this->assertInstanceOf('Calculator\Operator\Multiply', $operator);

        $operator = OperatorFactory::createOperator('/');
        $this->assertInstanceOf('Calculator\Operator\Divide', $operator);
    }

    public function testInvalidConstruct()
    {
        $this->setExpectedException('\Exception', 'Invalid operator');
        OperatorFactory::createOperator('^');
    }
}