<?php
use Calculator\Operator\Sine;

describe('Sine', function () {

    beforeEach(function () {
        $this->obj = new Sine();
    });

    describe('getOperator', function () {
        it('gets operator', function () {
            expect($this->obj->getOperator())->toEqual('sin');
        });
    });

    describe('getPrecedence', function () {
        it('gets precedence', function () {
            expect($this->obj->getPrecedence())->toEqual(Sine::PRECEDENCE_MEDIUM);
        });
    });

    describe('execute', function () {
        it('executes operation', function () {
            expect($this->obj->execute(0, -M_PI_2))->toEqual(-1);
            expect($this->obj->execute(0, -M_PI))->toBeCloseTo(0, 0);
            expect($this->obj->execute(0, M_PI_2))->toEqual(1);
        });
        it('executes operation with first parameter (that is ignored)', function () {
            expect($this->obj->execute(333, -M_PI_2))->toEqual(-1);
            expect($this->obj->execute(222, -M_PI))->toBeCloseTo(0, 0);
            expect($this->obj->execute(-111, M_PI_2))->toEqual(1);
        });
        it('executes wrong operation', function () {
            expect($this->obj->execute(0, 33))->toBeGreaterThan(0)->toBeLessThan(M_PI);
            expect($this->obj->execute(0, -33))->toBeLessThan(0)->toBeGreaterThan(-M_PI);
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
            expect($this->obj->getStringBrackets())->toBeTruthy();
        });
    });

    describe('__toString', function () {
        it('converts to string', function () {
            expect((string)$this->obj)->toEqual('sin');
        });
    });
});