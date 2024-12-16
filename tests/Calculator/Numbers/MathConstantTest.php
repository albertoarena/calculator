<?php

namespace Tests\Calculator\Numbers;

use Calculator\Concerns\HasPhi;
use Calculator\Numbers\MathConstant;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class MathConstantTest extends TestCase
{
    use HasPhi;

    #[Test]
    public function it_can_create_a_math_constant()
    {
        $constant = new MathConstant('pi', M_PI);
        $this->assertEquals('pi', $constant->constant);
        $this->assertEquals(M_PI, $constant->value);
        $this->assertFalse($constant->greekLetters);

        $constant = new MathConstant('φ', self::getPhi(), true);
        $this->assertEquals('φ', $constant->constant);
        $this->assertEquals(self::getPhi(), $constant->value);
        $this->assertTrue($constant->greekLetters);
    }
}
