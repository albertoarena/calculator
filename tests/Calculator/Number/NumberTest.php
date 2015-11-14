<?php
namespace Calculator\Number;

class NumberTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Number
     */
    protected $number;

    public function assertPreConditions()
    {
        $this->number = new Number(123);
    }

    public function testConstruct()
    {
        $this->assertEquals(123, $this->number->getValue());
    }

    public function testToString()
    {
        $this->assertEquals("123", (string) $this->number);
    }

    public function testGetType()
    {
        $this->assertEquals('number', $this->number->getType());
    }

    public function testGetStringOrder()
    {
        $this->assertEquals(1, $this->number->getStringOrder());
    }
}