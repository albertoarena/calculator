<?php
namespace Calculator\Operator;


class CosineTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Sine
     */
    protected $operator;

    public function assertPreConditions()
    {
        $this->operator = new Cosine();
    }

    public function testConstruct()
    {
        $this->assertEquals('cos', $this->operator->getOperator());
    }

    public function testPrecedence()
    {
        $this->assertEquals(Operator::PRECEDENCE_MEDIUM, $this->operator->getPrecedence());
    }

    public function testExecute()
    {
        $this->assertEquals(-1, $this->operator->execute(0, pi()));
        $this->assertEquals(0, $this->operator->execute(0, pi() / 2));
        $this->assertEquals(1, $this->operator->execute(0, 0));
    }

    public function testToString()
    {
        $this->assertEquals("cos", (string) $this->operator);
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