<?php

namespace Tests\Calculator\Numbers;

use Calculator\Calculator;
use Calculator\Exceptions\InvalidNumberException;
use Calculator\Numbers\Group;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class GroupTest extends TestCase
{
    /**
     * @throws InvalidNumberException
     */
    #[Test]
    public function it_can_create_a_group_and_process()
    {
        $group = new Group(
            closure: function (Calculator $calculator) {
                $calculator->number(M_PI / 6)
                    ->operator('cos');
            });
        $result = $group->process();
        $this->assertEqualsWithDelta(0.86602540378444, $result, 0.000000001);
        $this->assertEquals('(cos(0.5235987755983))', (string) $group);
    }

    /**
     * @throws InvalidNumberException
     */
    #[Test]
    public function it_can_create_a_group_with_custom_precision_and_process()
    {
        $group = new Group(
            closure: function (Calculator $calculator) {
                $calculator->number(M_PI / 6)
                    ->operator('cos');
            },
            precision: 5
        );
        $result = $group->process();
        $this->assertEqualsWithDelta(0.86602540378444, $result, 0.000000001);
        $this->assertEquals('(cos(0.5236))', (string) $group);
    }

    /**
     * @throws InvalidNumberException
     */
    #[Test]
    public function it_can_create_a_group_with_math_constant_and_process()
    {
        $group = new Group(
            closure: function (Calculator $calculator) {
                $calculator->number('π')
                    ->operator('tan');
            }
        );
        $result = $group->process();
        $this->assertEqualsWithDelta(0, $result, 0.000000001);
        $this->assertEquals('(tan(pi))', (string) $group);
    }

    /**
     * @throws InvalidNumberException
     */
    #[Test]
    public function it_can_create_a_group_with_math_constant_using_greek_letters_and_process()
    {
        $group = new Group(
            closure: function (Calculator $calculator) {
                $calculator->number('pi')
                    ->operator('tan');
            },
            greekLetters: true
        );
        $result = $group->process();
        $this->assertEqualsWithDelta(0, $result, 0.000000001);
        $this->assertEquals('(tan(π))', (string) $group);
    }
}
