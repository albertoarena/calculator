<?php
use Calculator\Number\Result;
use Calculator\Exception\InvalidNumberException;

describe('Result', function () {

    beforeEach(function () {
        $this->obj = new Result(123);
    });

    afterEach(function () {
    });

    describe('constructor', function () {
        it('constructs with correct value', function () {
            expect(function () {
                new Result(456);
            })->not->toThrow(new InvalidNumberException(456));
            expect(function () {
                new Result(4.56);
            })->not->toThrow(new InvalidNumberException(4.56));
            expect(function () {
                new Result('456');
            })->toThrow(new InvalidNumberException('456'));
            expect(function () {
                new Result('4.56');
            })->toThrow(new InvalidNumberException('4.56'));
            expect(function () {
                new Result('abc');
            })->toThrow(new InvalidNumberException('abc'));
            expect(function () {
                new Result(true);
            })->toThrow(new InvalidNumberException(true));
            expect(function () {
                new Result(array());
            })->toThrow(new InvalidNumberException(array()));
            expect(function () {
                new Result(new stdClass());
            })->toThrow(new InvalidNumberException(new stdClass()));
        });
    });

    describe('getType', function () {
        it('gets type', function () {
            expect($this->obj->getType())->toEqual('result');
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
            expect((string)$this->obj)->toEqual('= 123');
            expect((string)new Result(456))->toEqual('= 456');
            expect((string)new Result(4.56))->toEqual('= 4.56');
        });
    });

});
