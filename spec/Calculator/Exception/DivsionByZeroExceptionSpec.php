<?php
use Calculator\Exception\DivisionByZeroException;

describe('DivisionByZeroException', function () {

    describe('constructor', function () {
        it('instantiates an object', function () {
            expect(function () {
                throw new DivisionByZeroException('123');
            })->toThrow(new DivisionByZeroException('123'));
        });
    });

});