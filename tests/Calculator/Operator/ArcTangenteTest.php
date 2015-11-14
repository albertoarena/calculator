<?php
namespace Calculator\Operator;


class ArcTangentTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Sine
     */
    protected $operator;

    public function assertPreConditions()
    {
        $this->operator = new ArcTangent();
    }

    public function testConstruct()
    {
        $this->assertEquals('atan', $this->operator->getOperator());
    }

    public function testPrecedence()
    {
        $this->assertEquals(Operator::PRECEDENCE_MEDIUM, $this->operator->getPrecedence());
    }

    public function testExecute()
    {
        $this->assertEquals(-pi() / 4, $this->operator->execute(0, -1));
        $this->assertEquals(0, $this->operator->execute(0, 0));
        $this->assertEquals(pi() / 4, $this->operator->execute(0, 1));
    }

    public function testToString()
    {
        $this->assertEquals("atan", (string)$this->operator);
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