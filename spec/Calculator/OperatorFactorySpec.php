<?php
use Calculator\OperatorFactory;

describe('OperatorFactory', function () {

    describe('createOperator', function () {
        it('creates operator object', function () {
            expect(OperatorFactory::createOperator('+'))->toBeAnInstanceOf('Calculator\Operator\Add');
            expect(OperatorFactory::createOperator('-'))->toBeAnInstanceOf('Calculator\Operator\Subtract');
            expect(OperatorFactory::createOperator('*'))->toBeAnInstanceOf('Calculator\Operator\Multiply');
            expect(OperatorFactory::createOperator('/'))->toBeAnInstanceOf('Calculator\Operator\Divide');
            expect(OperatorFactory::createOperator('^'))->toBeAnInstanceOf('Calculator\Operator\Pow');
            expect(OperatorFactory::createOperator('√'))->toBeAnInstanceOf('Calculator\Operator\SquareRoot');
            expect(OperatorFactory::createOperator('sqrt'))->toBeAnInstanceOf('Calculator\Operator\SquareRoot');
            expect(OperatorFactory::createOperator('sin'))->toBeAnInstanceOf('Calculator\Operator\Sine');
            expect(OperatorFactory::createOperator('cos'))->toBeAnInstanceOf('Calculator\Operator\Cosine');
            expect(OperatorFactory::createOperator('tan'))->toBeAnInstanceOf('Calculator\Operator\Tangent');
            expect(OperatorFactory::createOperator('asin'))->toBeAnInstanceOf('Calculator\Operator\ArcSine');
            expect(OperatorFactory::createOperator('acos'))->toBeAnInstanceOf('Calculator\Operator\ArcCosine');
            expect(OperatorFactory::createOperator('atan'))->toBeAnInstanceOf('Calculator\Operator\ArcTangent');
        });

        it('does not create an operator object', function () {
            expect(function () {
                OperatorFactory::createOperator('£');
            })->toThrow(new \Calculator\Exception\InvalidOperatorException('£'));
            expect(function () {
                OperatorFactory::createOperator(null);
            })->toThrow(new \Calculator\Exception\InvalidOperatorException(null));
        });
    });

});