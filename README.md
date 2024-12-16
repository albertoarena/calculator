# Calculator

![build-test](coverage.svg)

Simple PHP calculator, inspired by [shunting-yard algorithm](http://en.wikipedia.org/wiki/Shunting-yard_algorithm).

It supports basic operators (+, -, /, \*, ^), trigonometric operators and precedence.

## Compatibility

| What | Version |
|------|---------|
| PHP  | 8.2     |


## Operators

Operator precedence follows the standard (see [Wikipedia](https://en.wikipedia.org/wiki/Order_of_operations#Definition)):

| Operator | Alias  | Precedence | Description      |
|----------|--------|------------|------------------|
| `^`      | `**`   | High       | exponent (power) |
| `√`      | `sqrt` | High       | square root      |
| `!`      |        | High       | Fibonacci number |
| `%`      |        | High       | percentage       |
| `*`      |        | Medium     | multiplication   |
| `/`      |        | Medium     | division         |
| `sin`    |        | Medium     | sine             |
| `cos`    |        | Medium     | cosine           |
| `tan`    |        | Medium     | tangent          |
| `asin`   |        | Medium     | arc sine         |
| `acos`   |        | Medium     | arc cosine       |
| `atan`   |        | Medium     | arc tangent      |
| `+`      |        | Low        | addition         |
| `-`      |        | Low        | subtraction      |

## How to use it

A working example is available in `samples/basic.php`.

```php
use Calculator\Calculator;

$calculator = new Calculator();

// ----------------------------
// Basic operators
// ----------------------------
$calculator->number(1)
    ->operator('+')->number(5)
    ->operator('*')->number(3.5)
    ->operator('/')->number(2)
    ->execute();

echo $calculator;
// ==> 1 + 5 * 3.5 / 2 = 9.75

// ----------------------------
// Power
// ----------------------------
$calculator->number(2)
    ->operator('*')->number(2)
    ->operator('^')->number(4)
    ->execute();

echo $calculator;
// ==> 2 * 2 ^ 4 = 32

// ----------------------------
// Square root
// ----------------------------
$result = $calculator->number(9)
    ->operator('√')
    ->execute();

echo $calculator;
// ==> √9 = 3

// ----------------------------
// Trigonometry
// ----------------------------
$result = $calculator->number(1)
    ->operator('cos')
    ->execute();

echo $calculator;
// ==> cos(1) = 0.54030230586814

// ----------------------------
// Fibonacci number
// ----------------------------
$result = $calculator->number(40)
    ->operator('!')
    ->execute();

echo $calculator;
// ==> 40! = 102334155

// ----------------------------
// Percentage
// ----------------------------
$result = $calculator->number(40.32)
    ->operator('%')
    ->execute();

echo $calculator;
// ==> 40.32% = 0.4032

// ----------------------------
// Group operations (parentheses)
// ----------------------------
$result = $calculator
    ->group(function (Calculator $calculator) {
        $calculator
            ->number('pi')
            ->operator('/')->number(4);
    })
    ->operator('cos')
    ->execute();

echo $calculator;
// ==> cos(pi / 4) = 0.7071067811865

```