<?php
namespace Calculator\Stack;


class StackTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Stack
     */
    protected $stack;

    public function assertPreConditions()
    {
        $this->stack = new Stack();
    }

    public function testConstruct()
    {
        $this->assertEquals(0, $this->stack->count());
    }

    public function testPush()
    {
        $this->assertEquals(0, $this->stack->count());
        $this->stack->push(1);
        $this->assertEquals(1, $this->stack->count());
        $this->stack->push(5);
        $this->assertEquals(2, $this->stack->count());
        $this->stack->push(3);
        $this->assertEquals(3, $this->stack->count());
    }

    public function testPop()
    {
        $this->assertEquals(0, $this->stack->count());
        $this->assertNull($this->stack->pop());
        $this->stack->push(1);
        $this->stack->push(5);
        $this->stack->push(3);
        $this->assertEquals(3, $this->stack->count());
        $this->assertEquals(3, $this->stack->pop());
        $this->assertEquals(2, $this->stack->count());
        $this->assertEquals(5, $this->stack->pop());
        $this->assertEquals(1, $this->stack->count());
        $this->assertEquals(1, $this->stack->pop());
        $this->assertEquals(0, $this->stack->count());
    }

    public function testPrepend()
    {
        $this->assertEquals(0, $this->stack->count());
        $this->stack->prepend(1);
        $this->assertEquals(1, $this->stack->count());
        $this->stack->prepend(5);
        $this->assertEquals(2, $this->stack->count());
        $this->stack->prepend(3);
        $this->assertEquals(3, $this->stack->count());
    }


    public function testShift()
    {
        $this->assertEquals(0, $this->stack->count());
        $this->assertNull($this->stack->shift());
        $this->stack->prepend(1);
        $this->stack->prepend(5);
        $this->stack->prepend(3);
        $this->assertEquals(3, $this->stack->count());
        $this->assertEquals(3, $this->stack->shift());
        $this->assertEquals(2, $this->stack->count());
        $this->assertEquals(5, $this->stack->shift());
        $this->assertEquals(1, $this->stack->count());
        $this->assertEquals(1, $this->stack->shift());
        $this->assertEquals(0, $this->stack->count());
    }

    public function testReset()
    {
        $this->assertEquals(0, $this->stack->count());
        $this->stack->push(1);
        $this->stack->push(5);
        $this->stack->push(3);
        $this->assertEquals(3, $this->stack->count());
        $this->stack->reset();
        $this->assertEquals(0, $this->stack->count());
    }

    public function testCurrent()
    {
        $this->assertEquals(0, $this->stack->count());
        $this->assertNull($this->stack->current());
        $this->stack->push(5);
        $this->assertEquals(1, $this->stack->count());
        $this->assertEquals(5, $this->stack->current());
        $this->stack->push(3);
        $this->assertEquals(2, $this->stack->count());
        $this->assertEquals(3, $this->stack->current());
        $this->stack->push(20);
        $this->assertEquals(3, $this->stack->count());
        $this->assertEquals(20, $this->stack->current());
    }
} 