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

        $operator = OperatorFactory::createOperator('^');
        $this->assertInstanceOf('Calculator\Operator\Pow', $operator);

        $operator = OperatorFactory::createOperator('√');
        $this->assertInstanceOf('Calculator\Operator\SquareRoot', $operator);

        $operator = OperatorFactory::createOperator('sqrt');
        $this->assertInstanceOf('Calculator\Operator\SquareRoot', $operator);

        $operator = OperatorFactory::createOperator('sin');
        $this->assertInstanceOf('Calculator\Operator\Sine', $operator);

        $operator = OperatorFactory::createOperator('cos');
        $this->assertInstanceOf('Calculator\Operator\Cosine', $operator);

        $operator = OperatorFactory::createOperator('tan');
        $this->assertInstanceOf('Calculator\Operator\Tangent', $operator);

        $operator = OperatorFactory::createOperator('asin');
        $this->assertInstanceOf('Calculator\Operator\ArcSine', $operator);

        $operator = OperatorFactory::createOperator('acos');
        $this->assertInstanceOf('Calculator\Operator\ArcCosine', $operator);

        $operator = OperatorFactory::createOperator('atan');
        $this->assertInstanceOf('Calculator\Operator\ArcTangent', $operator);
    }

    public function testInvalidConstruct()
    {
        $this->setExpectedException('\Calculator\Exception\InvalidOperatorException', 'Invalid operator');
        OperatorFactory::createOperator('£');
    }
}