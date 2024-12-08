<?php

namespace Tests\Mocks;

use Calculator\Entity;

class MockEntity extends Entity
{
    public function getType(): string
    {
        return 'mock';
    }

    public function __toString()
    {
        return 'mock';
    }
}
