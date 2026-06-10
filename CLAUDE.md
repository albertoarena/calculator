# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project

PHP 8.2 calculator library implementing the [shunting-yard algorithm](http://en.wikipedia.org/wiki/Shunting-yard_algorithm). Supports basic operators (+, -, *, /, ^), `√`, `!` (Fibonacci), `%`, trigonometric functions (sin/cos/tan/asin/acos/atan), parentheses via `group()`, and math constants (e.g. `pi`, `phi`). Public API is the fluent `Calculator\Calculator` class — see `samples/basic.php` and `README.md`.

## Commands

Composer scripts (run from repo root):

- `composer test` — PHPUnit test suite (`--testdox`).
- `composer static` — PHPStan analysis (level 5, with larastan extension; scans `src/`, `tests/`, `samples/`).
- `composer fix` — Apply Laravel Pint formatting.
- `composer check` — Pint in `--test` mode (no writes).
- `composer all` — test + fix + check + static.
- `composer test-coverage` — HTML + clover coverage to `reports/` and `clover.xml`, plus regenerated `coverage.svg` badge (requires Xdebug; uses `--process-isolation`).

Run a single test: `./vendor/bin/phpunit --filter <TestMethodOrClass> tests` (e.g. `--filter testItCanAddNumbers`).

Note PHPUnit config is strict: `failOnRisky`, `failOnWarning`, `failOnPhpunitDeprecation` are all enabled — warnings and risky tests are real failures.

## Architecture

Two interacting stacks drive the algorithm; a third queue is kept for stringification only.

`Calculator` (`src/Calculator/Calculator.php`) holds three `Stack`s:
- `$output` — operand stack (instances of `Number`).
- `$operators` — operator stack used to enforce precedence.
- `$queue` — append-only record of every token (numbers, operators, groups, final `Result`) — consumed by `__toString()` via `QueueToStringTransformer`, not by evaluation.

Fluent calls `number()`, `operator()`, `group()`, `negative()` all funnel into `process()`. On each operator: if the previous operator on the stack has greater-or-equal precedence, it is executed immediately (popping two operands from `$output`, pushing the result back as a `Number`), then the new operator is pushed. `execute()` calls `finaliseProcess()` which drains the operator stack the same way, then pops the final value off `$output`.

Domain model (all extend the abstract `Calculator\Entity` and implement narrow contracts in `src/Calculator/Contracts/`):
- `Numbers/Number` — wraps int/float/string operand. String input may be a math constant name (resolved by `Factories/MathConstantFactory` to a `MathConstant` like `Pi`, `Phi`, `E`).
- `Numbers/Group` — parentheses. Constructed with a `Closure` that receives a nested `Calculator` instance; evaluation runs that sub-calculator and the group exposes its result as a single value.
- `Numbers/Result` — terminal token recorded into the queue at the end of `execute()` purely for `__toString()` output.
- `Operators/Operator` — abstract base; concrete operators (`Add`, `Subtract`, `Multiply`, `Divide`, `Pow`, `SquareRoot`, `Fibonacci`, `Percentage`, `Negative`, and `TrigonometricOperator` subclasses `Sine`/`Cosine`/`Tangent`/`ArcSine`/`ArcCosine`/`ArcTangent`) define `getPrecedence()` and `execute($v1, $v2)`. `Factories/OperatorFactory` maps the user-supplied string symbol (and aliases like `**` / `sqrt`) to the right class.

Precedence tiers come from `Contracts/OperatorInterface` constants. To add an operator: subclass `Operator` (or `TrigonometricOperator`), register its symbol(s) in `OperatorFactory`, and add precedence/execution logic. Unary operators (e.g. `Fibonacci`, `Percentage`, `SquareRoot`, trig) ignore one of the operands inside `execute()`.

Exceptions live under `Exceptions/` and all extend `Exceptions\Exception`. Errors raised during evaluation: `InvalidNumberException`, `InvalidOperatorException`, `DivisionByZeroException`, `InfiniteException`, `NotANumberException`.

## Conventions

- Autoload: `src/` uses PSR-0 under namespace `Calculator` (note: PSR-0, not PSR-4 — namespace segments map to directories but the class file lives at `src/Calculator/...`). Tests use PSR-4 under `Tests\`.
- Pint preset is `laravel` with tweaks in `pint.json` (notably `braces: false`, custom `new_with_braces`, `yoda_style.always_move_variable: false`). Run `composer fix` rather than hand-formatting.
- The `Calculator` constructor takes `precision`, `resultInString` (controls `__toString` formatting), and `greekLetters` (controls how constants are rendered) — preserve these when adding features that affect numeric output.

## TDD

Follow red-green-refactor for any change to `src/`:

1. **Red** — write a failing test in `tests/` that pins the desired behaviour (new feature) or reproduces the bug (fix). Confirm it fails for the right reason with `./vendor/bin/phpunit --filter <name> tests`.
2. **Green** — write the minimum code in `src/` to make that test pass. No extra scope.
3. **Refactor** — clean up with the full suite green (`composer test`).

Do not modify `src/` without a failing test first. Bug fixes start with a regression test.

## Git Commit Conventions

### Format

- type: short subject line (max 50 chars)
- Detailed body paragraph explaining what and why (not how).

### Rules

- No Claude attribution - NEVER include "Generated with Claude Code" or "Co-Authored-By: Claude"
- Keep first line under 50 characters
- Use heredoc for multi-line commit messages
