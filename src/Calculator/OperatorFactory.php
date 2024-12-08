<?php

namespace Calculator;

use Calculator\Exceptions\InvalidOperatorException;
use Calculator\Operators\Add;
use Calculator\Operators\ArcCosine;
use Calculator\Operators\ArcSine;
use Calculator\Operators\ArcTangent;
use Calculator\Operators\Cosine;
use Calculator\Operators\Divide;
use Calculator\Operators\Multiply;
use Calculator\Operators\Pow;
use Calculator\Operators\Sine;
use Calculator\Operators\SquareRoot;
use Calculator\Operators\Subtract;
use Calculator\Operators\Tangent;

class OperatorFactory
{
    protected static array $operators = [
        '+' => Add::class,
        '-' => Subtract::class,
        '*' => Multiply::class,
        '/' => Divide::class,
        '^' => Pow::class,
        '**' => Pow::class, // alias for pow
        '√' => SquareRoot::class,
        'sqrt' => SquareRoot::class, // alias for square root
        'sin' => Sine::class,
        'cos' => Cosine::class,
        'tan' => Tangent::class,
        'asin' => ArcSine::class,
        'acos' => ArcCosine::class,
        'atan' => ArcTangent::class,
    ];

    /**
     * @throws InvalidOperatorException
     */
    public static function createOperator($operator)
    {
        if (array_key_exists($operator, self::$operators)) {
            return new self::$operators[$operator];
        } else {
            throw new InvalidOperatorException($operator);
        }
    }
}
