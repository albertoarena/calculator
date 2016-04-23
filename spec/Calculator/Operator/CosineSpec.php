<?php
use Calculator\Operator\Cosine;

describe('Cosine', function () {

    beforeEach(function () {
        $this->obj = new Cosine();
    });

    describe('getOperator', function () {
        it('gets operator', function () {
            expect($this->obj->getOperator())->toEqual('cos');
        });
    });

    describe('getPrecedence', function () {
        it('gets precedence', function () {
            expect($this->obj->getPrecedence())->toEqual(Cosine::PRECEDENCE_MEDIUM);
        });
    });

    describe('execute', function () {
        it('executes operation', function () {
            expect($this->obj->execute(0, -M_PI))->toEqual(-1);
            expect($this->obj->execute(0, -M_PI_2))->toBeCloseTo(0, 0);
            expect($this->obj->execute(0, 0))->toEqual(1);
            expect($this->obj->execute(0, M_PI_2))->toBeCloseTo(0, 0);
            expect($this->obj->execute(0, M_PI))->toEqual(-1);
        });
        it('executes operation with first parameter (that is ignored)', function () {
            expect($this->obj->execute(3333, -M_PI))->toEqual(-1);
            expect($this->obj->execute(2222, -M_PI_2))->toBeCloseTo(0, 0);
            expect($this->obj->execute(1111, 0))->toEqual(1);
            expect($this->obj->execute(-2222, M_PI_2))->toBeCloseTo(0, 0);
            expect($this->obj->execute(-3333, M_PI))->toEqual(-1);
        });
        it('executes wrong operation', function () {
            expect($this->obj->execute(0, 33))->toBeLessThan(0);
            expect($this->obj->execute(0, -33))->toBeLessThan(0);
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
            expect((string)$this->obj)->toEqual('cos');
        });
    });
});