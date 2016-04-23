<?php
use Calculator\Exception\InvalidOperatorException;

describe('InvalidOperatorException', function () {

    describe('constructor', function () {
        it('instantiates an object', function () {
            expect(function () {
                throw new InvalidOperatorException('123');
            })->toThrow(new InvalidOperatorException('123'));
        });
    });

});