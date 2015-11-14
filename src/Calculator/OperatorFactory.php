<?php
namespace Calculator;


use Calculator\Exception\InvalidOperatorException;

class OperatorFactory
{
    protected static $operators = array(
        '+' => 'Calculator\Operator\Add',
        '-' => 'Calculator\Operator\Subtract',
        '*' => 'Calculator\Operator\Multiply',
        '/' => 'Calculator\Operator\Divide',
        '^' => 'Calculator\Operator\Pow',
        '√' => 'Calculator\Operator\SquareRoot',
        'sqrt' => 'Calculator\Operator\SquareRoot', // alias for square root
        'sin' => 'Calculator\Operator\Sine',
        'cos' => 'Calculator\Operator\Cosine',
        'tan' => 'Calculator\Operator\Tangent',
        'asin' => 'Calculator\Operator\ArcSine',
        'acos' => 'Calculator\Operator\ArcCosine',
        'atan' => 'Calculator\Operator\ArcTangent',
    );

    public static function createOperator($operator)
    {
        if (array_key_exists($operator, self::$operators)) {
            return new self::$operators[$operator]();
        } else {
            throw new InvalidOperatorException($operator);
        }
    }

} 