<?php
use Calculator\Operator\Negative;

describe('Negative', function () {

    beforeEach(function () {
        $this->obj = new Negative();
    });

    describe('getOperator', function () {
        it('gets operator', function () {
            expect($this->obj->getOperator())->toEqual('-');
        });
    });

    describe('getPrecedence', function () {
        it('gets precedence', function () {
            expect($this->obj->getPrecedence())->toEqual(Negative::PRECEDENCE_HIGH);
        });
    });

    describe('execute', function () {
        it('executes operation', function () {
            expect($this->obj->execute(0, 10))->toEqual(-10);
            expect($this->obj->execute(0, M_PI))->toBeCloseTo(-M_PI, 0);
            expect($this->obj->execute(0, 0))->toEqual(0);
            expect($this->obj->execute(0, -M_PI))->toBeCloseTo(M_PI, 0);
            expect($this->obj->execute(0, -10))->toEqual(10);
        });
    });

    describe('getType', function () {
        it('gets type', function () {
            expect($this->obj->getType())->toEqual('operator');
        });
    });

    describe('getStringOrder', function () {
        it('gets string order', function () {
            expect($this->obj->getStringOrder())->toBe(-1);
        });
    });

    describe('getStringBrackets', function () {
        it('gets string brackets', function () {
            expect($this->obj->getStringBrackets())->toBeFalsy();
        });
    });

    describe('__toString', function () {
        it('converts to string', function () {
            expect((string)$this->obj)->toEqual('-');
        });
    });
});