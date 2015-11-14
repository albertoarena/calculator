Calculator
===

Simple PHP calculator, inspired by [shunting-yard algorithm](http://en.wikipedia.org/wiki/Shunting-yard_algorithm).

Support of basic operators (+, -, /, \*, ^) and operator precedence.

Operators
---

The Order of operators follows the standard (see [Wikipedia](https://en.wikipedia.org/wiki/Order_of_operations#Definition)):

High precedence

- `^`: exponent (power)

Medium precedence

- `\*`: multiplication
- `/`: division

Low precedence

- `+`: addition
- `-`: subtraction

How to use it
---

A working example is available in `samples/basic.php`.

```php
use Calculator\Calculator;

$calculator = new Calculator();

$calculator->number(1)
    ->operator('+')->number(5)
    ->operator('*')->number(3.5)
    ->operator('/')->number(2)
    ->execute();

echo $calculator;
// ==> 1 + 5 * 3.5 / 2 = 9.75

$calculator->number(2)
    ->operator('*')->number(2)
    ->operator('^')->number(4)
    ->execute();

echo $calculator;
// ==> 2 * 2 ^ 4 = 32

```