<?php

namespace Tests\Calculator;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\Mocks\MockEntity;

class EntityTest extends TestCase
{
    #[Test]
    public function it_can_create_entity_type()
    {
        $obj = new MockEntity;
        $this->assertEquals('mock', $obj->getType());
        $this->assertEquals(1, $obj->getStringOrder());
        $this->assertFalse($obj->getStringBrackets());
        $this->assertEquals('mock', (string) $obj);
    }
}
