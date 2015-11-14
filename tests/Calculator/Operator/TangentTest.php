<?php
namespace Calculator\Operator;


class TangentTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Sine
     */
    protected $operator;

    public function assertPreConditions()
    {
        $this->operator = new Tangent();
    }

    public function testConstruct()
    {
        $this->assertEquals('tan', $this->operator->getOperator());
    }

    public function testPrecedence()
    {
        $this->assertEquals(Operator::PRECEDENCE_MEDIUM, $this->operator->getPrecedence());
    }

    public function testExecute()
    {
        $this->assertEquals(-1, $this->operator->execute(0, -pi() / 4));
        $this->assertEquals(0, $this->operator->execute(0, 0));
        $this->assertEquals(1, $this->operator->execute(0, pi() / 4));
    }

    public function testToString()
    {
        $this->assertEquals("tan", (string) $this->operator);
    }

    public function testGetType()
    {
        $this->assertEquals('operator', $this->operator->getType());
    }

    public function testGetStringOrder()
    {
        $this->assertEquals(-1, $this->operator->getStringOrder());
    }
}