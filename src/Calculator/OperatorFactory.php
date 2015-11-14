<?php
namespace Calculator;


class OperatorFactory
{
    protected static $operators = array(
        '+' => 'Calculator\Operator\Add',
        '-' => 'Calculator\Operator\Subtract',
        '*' => 'Calculator\Operator\Multiply',
        '/' => 'Calculator\Operator\Divide',
        '^' => 'Calculator\Operator\Pow',
    );

    public static function createOperator($operator)
    {
        if (array_key_exists($operator, self::$operators)) {
            return new self::$operators[$operator]();
        } else {
            throw new \Exception('Invalid operator');
        }
    }

} 