<?php
namespace Calculator\Operator;


class SineTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Sine
     */
    protected $operator;

    public function assertPreConditions()
    {
        $this->operator = new Sine();
    }

    public function testConstruct()
    {
        $this->assertEquals('sin', $this->operator->getOperator());
    }

    public function testPrecedence()
    {
        $this->assertEquals(Operator::PRECEDENCE_MEDIUM, $this->operator->getPrecedence());
    }

    public function testExecute()
    {
        $this->assertEquals(-1, $this->operator->execute(0, -pi() / 2));
        $this->assertEquals(0, $this->operator->execute(0, pi()));
        $this->assertEquals(1, $this->operator->execute(0, pi() / 2));
    }

    public function testToString()
    {
        $this->assertEquals("sin", (string) $this->operator);
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