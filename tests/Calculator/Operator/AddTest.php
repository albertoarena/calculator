<?php
namespace Calculator\Operator;


class AddTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Add
     */
    protected $operator;

    public function assertPreConditions()
    {
        $this->operator = new Add();
    }

    public function testConstruct()
    {
        $this->assertEquals('+', $this->operator->getOperator());
    }

    public function testExecute()
    {
        $this->assertEquals(5, $this->operator->execute(2, 3));
    }
} 