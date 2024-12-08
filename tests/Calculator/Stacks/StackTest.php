<?php

namespace Tests\Calculator\Stacks;

use Calculator\Exceptions\InvalidNumberException;
use Calculator\Numbers\Number;
use Calculator\Operators\Add;
use Calculator\Operators\Subtract;
use Calculator\Stacks\Stack;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class StackTest extends TestCase
{
    /**
     * @throws InvalidNumberException
     */
    #[Test]
    public function it_can_use_stack()
    {
        $stack = new Stack;
        $stack->push(new Number(1));
        $stack->push(new Add);
        $stack->push(new Number('2'));
        $this->assertEquals(3, $stack->count());

        $current = $stack->current();
        $this->assertInstanceOf(Number::class, $current);
        $this->assertEquals(2, $current->getValue());

        $stack->pop();
        $this->assertEquals(2, $stack->count());
        $current = $stack->current();
        $this->assertInstanceOf(Add::class, $current);

        $stack->prepend(new Subtract);
        $this->assertEquals(3, $stack->count());
        $stack->pop();
        $stack->pop();
        $current = $stack->current();
        $this->assertInstanceOf(Subtract::class, $current);

        $stack->reset();
        $this->assertEquals(0, $stack->count());
    }
}
