<?php
use Calculator\Calculator;

describe('Calculator', function () {

    beforeEach(function () {
        $this->obj = new Calculator();
    });

    describe('execute', function () {

        context('when empty', function () {
            it('calculates with no number or operator', function () {
                expect($this->obj->execute())->toBe(0);
            });
        });

        context('when using basic operators', function () {

            // 1 + 1 * 3 + 3 ==> 7
            it('calculates using integers', function () {
                expect($this->obj->number(1)
                    ->operator('+')->number(1)
                    ->operator('*')->number(3)
                    ->operator('+')->number(3)
                    ->execute())->toBe(7);
            });

            // 5 + 8 / 4 * 3 - 1 ==> 10
            it('calculates using integers and operators precedence', function () {
                expect($this->obj->number(5)
                    ->operator('+')->number(8)
                    ->operator('/')->number(4)
                    ->operator('*')->number(3)
                    ->operator('-')->number(1)
                    ->execute())->toBe(10);
            });

            // 0.5 + 30 / 8 + 3.6 * 1.4 ==> 9.29
            it('calculates using floats', function () {
                expect($this->obj->number(.5)
                    ->operator('+')->number(30)
                    ->operator('/')->number(8)
                    ->operator('+')->number(3.6)
                    ->operator('*')->number(1.4)
                    ->execute())->toBe(9.29);
            });

            // 2 * 2 ^ 4 ==> 32
            it('calculates using exponential expression and operators precedence', function () {
                expect($this->obj->number(2)
                    ->operator('*')->number(2)
                    ->operator('^')->number(4)
                    ->execute())->toBe(32);
            });

            it('calculates using square root', function () {
                // √9 ==> 3
                expect($this->obj->number(9)
                    ->operator('√')
                    ->execute())->toBeCloseTo(3, 0);
            });

            // sqrt 9 ==> 3
            it('calculates using square root alias', function () {
                expect($this->obj->number(9)
                    ->operator('sqrt')
                    ->execute())->toBeCloseTo(3, 0);
            });

        });

        context('when using trigonometric operators', function () {

            it('calculates sine', function () {
                expect($this->obj->number(0)
                    ->operator('sin')
                    ->execute())->toBeCloseTo(0, 0);

                expect($this->obj->number(45)
                    ->operator('sin')
                    ->execute())->toBeCloseTo(0.85090, 5);

                expect($this->obj->number(M_PI_2)
                    ->operator('sin')
                    ->execute())->toBeCloseTo(1, 0);

                expect($this->obj->number(90)
                    ->operator('sin')
                    ->execute())->toBeCloseTo(0.894, 5);

                expect($this->obj->number(M_PI)
                    ->operator('sin')
                    ->execute())->toBeCloseTo(0, 0);
            });

            it('calculates cosine', function () {
                expect($this->obj->number(0)
                    ->operator('cos')
                    ->execute())->toBeCloseTo(1, 0);

                expect($this->obj->number(45)
                    ->operator('cos')
                    ->execute())->toBeCloseTo(0.52532, 5);

                expect($this->obj->number(M_PI_2)
                    ->operator('cos')
                    ->execute())->toBeCloseTo(0, 0);

                expect($this->obj->number(90)
                    ->operator('cos')
                    ->execute())->toBeCloseTo(-0.44807, 5);

                expect($this->obj->number(M_PI)
                    ->operator('cos')
                    ->execute())->toBeCloseTo(-1, 0);
            });

            it('calculates tangent', function () {
                expect($this->obj->number(deg2rad(0))
                    ->operator('tan')
                    ->execute())->toBeCloseTo(0, 0);

                expect($this->obj->number(deg2rad(45))
                    ->operator('tan')
                    ->execute())->toBeCloseTo(1, 0);
            });

        });

        context('when using negative operator', function () {
            // 2 + 1 * (-3) + 5 ==> 4
            it('calculates using integers', function () {
                expect($this->obj->number(2)
                    ->operator('+')->number(1)
                    ->operator('*')->number(3)->negative()
                    ->operator('+')->number(5)
                    ->execute())->toBe(4);
            });

        });
    });

    describe('__toString', function () {

        context('when empty', function () {
            it('converts to a string', function () {
                expect((string)$this->obj)->toEqual('');
            });
        });

        context('when using basic operators', function () {
            it('converts to string', function () {
                $this->obj->number(1)
                    ->operator('+')->number(1)
                    ->operator('*')->number(3)
                    ->operator('+')->number(3)
                    ->execute();
                expect((string)$this->obj)->toEqual('1 + 1 * 3 + 3 = 7');
            });
        });

        context('when using negative operator', function () {
            it('converts to string', function () {
                $this->obj->number(2)
                    ->operator('+')->number(1)
                    ->operator('*')->number(3)->negative()
                    ->operator('+')->number(5)
                    ->execute();
                expect((string)$this->obj)->toEqual('2 + 1 * -3 + 5 = 4');
            });
        });

        context('when using square root', function () {
            it('converts to string', function () {
                $this->obj->number(9)
                    ->operator('√')
                    ->execute();
                expect((string)$this->obj)->toEqual('√9 = 3');
            });

            it('converts to string using square root alias', function () {
                $this->obj->number(9)
                    ->operator('sqrt')
                    ->execute();
                expect((string)$this->obj)->toEqual('√9 = 3');
            });
        });

        context('when using trigonometric operators', function () {
            it('converts to string', function () {
                $this->obj->number(1)->operator('sin')
                    ->operator('+')->number(1)->operator('cos')
                    ->operator('+')->number(1)->operator('tan')
                    ->operator('+')->number(1)->operator('asin')
                    ->operator('+')->number(1)->operator('acos')
                    ->operator('+')->number(1)->operator('atan')
                    ->execute();
                expect((string)$this->obj)->toEqual('sin(1) + cos(1) + tan(1) + asin(1) + acos(1) + atan(1) = 0.78539816339745');
            });
        });
    });

});