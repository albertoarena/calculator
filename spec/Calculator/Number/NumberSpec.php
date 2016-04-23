<?php
use Calculator\Number\Number;
use Calculator\Exception\InvalidNumberException;

describe('Number', function () {

    beforeEach(function () {
        $this->obj = new Number(123);
    });

    afterEach(function () {
    });

    describe('constructor', function () {
        it('constructs with correct value', function () {
            expect(function () {
                new Number(456);
            })->not->toThrow(new InvalidNumberException(456));
            expect(function () {
                new Number(4.56);
            })->not->toThrow(new InvalidNumberException(4.56));
            expect(function () {
                new Number('456');
            })->toThrow(new InvalidNumberException('456'));
            expect(function () {
                new Number('4.56');
            })->toThrow(new InvalidNumberException('4.56'));
            expect(function () {
                new Number('abc');
            })->toThrow(new InvalidNumberException('abc'));
            expect(function () {
                new Number(true);
            })->toThrow(new InvalidNumberException(true));
            expect(function () {
                new Number(array());
            })->toThrow(new InvalidNumberException(array()));
            expect(function () {
                new Number(new stdClass());
            })->toThrow(new InvalidNumberException(new stdClass()));
        });
    });

    describe('getType', function () {
        it('gets type', function () {
            expect($this->obj->getType())->toEqual('number');
        });
    });

    describe('getValue', function () {
        it('gets value', function () {
            expect($this->obj->getValue())->toBe(123);
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
            expect((string)$this->obj)->toEqual(123);
            expect((string)new Number(456))->toEqual(456);
            expect((string)new Number(4.56))->toEqual(4.56);
        });
    });

});
