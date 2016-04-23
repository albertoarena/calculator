<?php
use Calculator\Exception\InvalidNumberException;

describe('InvalidNumberException', function () {

    describe('constructor', function () {
        it('instantiates an object', function () {
            expect(function () {
                throw new InvalidNumberException('123');
            })->toThrow(new InvalidNumberException('123'));
        });
    });

});