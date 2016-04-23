Calculator
===

Simple PHP calculator, inspired by [shunting-yard algorithm](http://en.wikipedia.org/wiki/Shunting-yard_algorithm).

Support of basic operators (+, -, /, \*, ^), trigonometric operators and precedence.

Operators
---

The Order of operators follows the standard (see [Wikipedia](https://en.wikipedia.org/wiki/Order_of_operations#Definition)):

High precedence

- `^`: exponent (power)
- `√`: square root (alias `sqrt`)

Medium precedence

- `\*`: multiplication
- `/`: division
- `sin`: sine
- `cos`: cosine
- `tan`: tangent
- `asin`: arc sine
- `acos`: arc cosine
- `atan`: arc tangent

Low precedence

- `+`: addition
- `-`: subtraction

How to use it
---

A working example is available in `samples/basic.php`.

```php
use Calculator\Calculator;

$calculator = new Calculator();

// Basic operators
$calculator->number(1)
    ->operator('+')->number(5)
    ->operator('*')->number(3.5)
    ->operator('/')->number(2)
    ->execute();

echo $calculator;
// ==> 1 + 5 * 3.5 / 2 = 9.75

// Power
$calculator->number(2)
    ->operator('*')->number(2)
    ->operator('^')->number(4)
    ->execute();

echo $calculator;
// ==> 2 * 2 ^ 4 = 32

// Square root
$result = $calculator->number(9)
    ->operator('√')
    ->execute();

echo $calculator;
// ==> √ 9 = 3

// Trigonometry
$result = $calculator->number(1)
    ->operator('cos')
    ->execute();

echo $calculator;
// ==> cos (1) = 0.54030230586814

```