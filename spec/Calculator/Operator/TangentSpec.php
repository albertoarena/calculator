<?php
use Calculator\Operator\Tangent;

describe('Tangent', function () {

    beforeEach(function () {
        $this->obj = new Tangent();
    });

    describe('getOperator', function () {
        it('gets operator', function () {
            expect($this->obj->getOperator())->toEqual('tan');
        });
    });

    describe('getPrecedence', function () {
        it('gets precedence', function () {
            expect($this->obj->getPrecedence())->toEqual(Tangent::PRECEDENCE_MEDIUM);
        });
    });

    describe('execute', function () {
        it('executes operation', function () {
            expect($this->obj->execute(0, -M_PI_4))->toBeCloseTo(-1, 0);
            expect($this->obj->execute(0, 0))->toBeCloseTo(0, 0);
            expect($this->obj->execute(0, M_PI_4))->toBeCloseTo(1, 0);
        });
        it('executes operation with first parameter (that is ignored)', function () {
            expect($this->obj->execute(333, -M_PI_4))->toBeCloseTo(-1, 0);
            expect($this->obj->execute(222, 0))->toBeCloseTo(0, 0);
            expect($this->obj->execute(-111, M_PI_4))->toBeCloseTo(1, 0);
        });
        it('executes wrong operation', function () {
            expect($this->obj->execute(0, 33))->toBeLessThan(0);
            expect($this->obj->execute(0, -33))->toBeGreaterThan(0);
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
            expect((string)$this->obj)->toEqual('tan');
        });
    });
});