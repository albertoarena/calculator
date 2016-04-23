<?php
use Calculator\Operator\Add;

describe('Operator', function () {

    beforeEach(function () {
        $this->obj = new Add();
    });

    describe('getOperator', function () {
        it('gets operator', function () {
            expect($this->obj->getOperator())->toEqual('+');
        });
    });

    describe('getPrecedence', function () {
        it('gets precedence', function () {
            expect($this->obj->getPrecedence())->toEqual(Add::PRECEDENCE_LOW);
        });
    });

    describe('execute', function () {
        it('executes operation', function () {
            expect($this->obj->execute(1, 2))->toEqual(3);
        });
    });

    describe('getType', function () {
        it('gets type', function () {
            expect($this->obj->getType())->toEqual('operator');
        });
    });

    describe('getStringOrder', function () {
        it('gets string order', function () {
            expect($this->obj->getStringOrder())->toBe(1);
        });
    });

    describe('getStringBrackets', function () {
        it('gets string brackets', function () {
            expect($this->obj->getStringBrackets())->toBeFalsy();
        });
    });

    describe('__toString', function () {
        it('converts to string', function () {
            expect((string)$this->obj)->toEqual('+');
        });
    });
});