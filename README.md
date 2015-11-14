Calculator
===

Simple PHP calculator, inspired by [shunting-yard algorithm](http://en.wikipedia.org/wiki/Shunting-yard_algorithm).

Support of basic operators (+, -, /, \*) and operator precedence.

How to use it
---

A working example is available in `/samples/basic.php`.

```php
use Calculator\Calculator;

$calculator = new Calculator();

$result = $calculator->number(1)
    ->operator('+')->number(5)
    ->operator('*')->number(3.5)
    ->operator('/')->number(2)
    ->execute();

echo $calculator;

// ==> 1 + 5 * 3.5 / 2 = 9.75
```