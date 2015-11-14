<?php
namespace Calculator\Operator;


class ArcCosineTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Sine
     */
    protected $operator;

    public function assertPreConditions()
    {
        $this->operator = new ArcCosine();
    }

    public function testConstruct()
    {
        $this->assertEquals('acos', $this->operator->getOperator());
    }

    public function testPrecedence()
    {
        $this->assertEquals(Operator::PRECEDENCE_MEDIUM, $this->operator->getPrecedence());
    }

    public function testExecute()
    {
        $this->assertEquals(pi(), $this->operator->execute(0, -1));
        $this->assertEquals(pi() / 2, $this->operator->execute(0, 0));
        $this->assertEquals(0, $this->operator->execute(0, 1));
    }

    public function testToString()
    {
        $this->assertEquals("acos", (string) $this->operator);
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