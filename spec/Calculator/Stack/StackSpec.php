<?php
use Calculator\Stack\Stack;

describe('Stack', function () {

    beforeEach(function () {
        $this->obj = new Stack();
    });

    describe('construct', function () {
        it('instantiates a new object', function () {
            expect($this->obj)->toBeAnInstanceOf('\Calculator\Stack\Stack');
            expect($this->obj->count())->toBe(0);
        });
    });

    describe('push', function () {
        it('pushes an element to the stack', function () {
            expect($this->obj->count())->toBe(0);
            $this->obj->push('abc');
            expect($this->obj->count())->toBe(1);
            expect($this->obj->pop())->toEqual('abc');
        });
    });

    describe('prepend', function () {
        it('prepends an element to the stack', function () {
            expect($this->obj->count())->toBe(0);
            $this->obj->prepend('abc');
            expect($this->obj->count())->toBe(1);
            expect($this->obj->shift())->toEqual('abc');
        });
    });

    describe('pop', function () {
        it('gets the latest element of the stack', function () {
            expect($this->obj->count())->toBe(0);
            $this->obj->push('abc');
            $this->obj->push('xyz');
            expect($this->obj->count())->toBe(2);
            expect($this->obj->pop())->toEqual('xyz');
            expect($this->obj->pop())->toEqual('abc');
        });
    });

    describe('shift', function () {
        it('gets the first element of the stack', function () {
            expect($this->obj->count())->toBe(0);
            $this->obj->prepend('abc');
            $this->obj->prepend('xyz');
            expect($this->obj->count())->toBe(2);
            expect($this->obj->shift())->toEqual('xyz');
            expect($this->obj->shift())->toEqual('abc');
        });
    });

    describe('count', function () {
        it('gets the number of elements in the stack', function () {
            expect($this->obj->count())->toBe(0);
            $this->obj->push('abc');
            expect($this->obj->count())->toBe(1);
            $this->obj->prepend('xyz');
            expect($this->obj->count())->toBe(2);
            $this->obj->shift();
            expect($this->obj->count())->toBe(1);
            $this->obj->pop();
            expect($this->obj->count())->toBe(0);
            $this->obj->pop();
            $this->obj->shift();
            expect($this->obj->count())->toBe(0);
        });
    });

    describe('reset', function () {
        it('resets the elements of the stack', function () {
            expect($this->obj->count())->toBe(0);
            $this->obj->push('abc');
            $this->obj->prepend('xyz');
            $this->obj->push(123);
            expect($this->obj->count())->toBe(3);
            $this->obj->reset();
            expect($this->obj->count())->toBe(0);
        });
    });

    describe('current', function () {
        it('gets last element of the stack', function () {
            expect($this->obj->count())->toBe(0);
            $this->obj->push('abc');
            expect($this->obj->current())->toEqual('abc');
            $this->obj->prepend('xyz');
            expect($this->obj->current())->toEqual('abc');
            $this->obj->push(123);
            expect($this->obj->current())->toEqual(123);
            $this->obj->reset();
            expect($this->obj->current())->toBeNull();
        });
    });
});