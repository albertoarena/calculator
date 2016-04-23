<?php
use spec\mock\MockEntity;

describe('Calculator', function () {

    beforeEach(function () {
        $this->obj = new MockEntity();
    });

    describe('getType', function () {
        it('gets type', function () {
            expect($this->obj->getType())->toEqual('mock');
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
            expect((string)$this->obj)->toEqual('mock');
        });
    });

});