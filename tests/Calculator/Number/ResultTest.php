<?php
namespace Calculator\Number;

class ResultTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Number
     */
    protected $result;

    public function assertPreConditions()
    {
        $this->result = new Result(123);
    }

    public function testConstruct()
    {
        $this->assertEquals(123, $this->result->getValue());
    }

    public function testToString()
    {
        $this->assertEquals("= 123", (string) $this->result);
    }

    public function testGetType()
    {
        $this->assertEquals('result', $this->result->getType());
    }

    public function testGetStringOrder()
    {
        $this->assertEquals(1, $this->result->getStringOrder());
    }
}