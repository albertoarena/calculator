<?php
namespace Calculator\Number;

class NumberTest extends \PHPUnit_Framework_TestCase
{

    public function testConstruct()
    {
        $n = new Number(123);
        $this->assertEquals(123, $n->getValue());
    }

    public function testToString()
    {
        $n = new Number(123);
        $this->assertEquals("123", (string) $n);
    }

} 