<?php
use spec\mock\MockException;

describe('Exception', function () {

    describe('constructor', function () {
        it('instantiates an object', function () {
            expect(function () {
                throw new MockException('123');
            })->toThrow(new MockException('123'));
        });
    });

});