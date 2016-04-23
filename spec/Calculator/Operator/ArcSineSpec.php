<?php
use Calculator\Operator\ArcSine;

describe('ArcSine', function () {

    beforeEach(function () {
        $this->obj = new ArcSine();
    });

    describe('getOperator', function () {
        it('gets operator', function () {
            expect($this->obj->getOperator())->toEqual('asin');
        });
    });

    describe('getPrecedence', function () {
        it('gets precedence', function () {
            expect($this->obj->getPrecedence())->toEqual(ArcSine::PRECEDENCE_MEDIUM);
        });
    });

    describe('execute', function () {
        it('executes operation', function () {
            expect($this->obj->execute(0, -1))->toEqual(-pi() / 2);
            expect($this->obj->execute(0, 0))->toEqual(0);
            expect($this->obj->execute(0, 1))->toEqual(pi() / 2);
        });
        it('executes wrong operation', function () {
            expect(is_nan($this->obj->execute(0, 33)))->toBeTruthy();
            expect(is_nan($this->obj->execute(33, 5)))->toBeTruthy();
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
            expect((string)$this->obj)->toEqual('asin');
        });
    });
});