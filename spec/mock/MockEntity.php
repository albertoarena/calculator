<?php

namespace spec\mock;

use Calculator\Entity;

class MockEntity extends Entity
{

    public function getType()
    {
        return 'mock';
    }

    public function __toString()
    {
        return 'mock';
    }
} 