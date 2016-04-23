<?php
use Calculator\Operator\ArcTangent;

describe('ArcTangent', function () {

    beforeEach(function () {
        $this->obj = new ArcTangent();
    });

    describe('getOperator', function () {
        it('gets operator', function () {
            expect($this->obj->getOperator())->toEqual('atan');
        });
    });

    describe('getPrecedence', function () {
        it('gets precedence', function () {
            expect($this->obj->getPrecedence())->toEqual(ArcTangent::PRECEDENCE_MEDIUM);
        });
    });

    describe('execute', function () {
        it('executes operation', function () {
            expect($this->obj->execute(0, -1))->toEqual(-M_PI_4);
            expect($this->obj->execute(0, 0))->toBeCloseTo(0, 0);
            expect($this->obj->execute(0, 1))->toEqual(M_PI_4);
        });
        it('executes operation with first parameter (that is ignored)', function () {
            expect($this->obj->execute(333, -1))->toEqual(-M_PI_4);
            expect($this->obj->execute(222, 0))->toBeCloseTo(0, 0);
            expect($this->obj->execute(-111, 1))->toEqual(M_PI_4);
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
            expect((string)$this->obj)->toEqual('atan');
        });
    });
});