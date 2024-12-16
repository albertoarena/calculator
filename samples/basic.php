#!/usr/bin/php
<?php

chdir(dirname(__DIR__));
require './vendor/autoload.php';

$cli = 'cli' === php_sapi_name() || defined('STDIN');
$cr = $cli ? "\n" : '<br>';

use Calculator\Calculator;

$calculator = new Calculator;

try {
    // ----------------------------
    // 1 + 5 * 3.5 / 2 = 9.75
    // ----------------------------
    $result = $calculator->number(1)
        ->operator('+')->number(5)
        ->operator('*')->number(3.5)
        ->operator('/')->number(2)
        ->execute();

    echo 'Result: '.$result.$cr;
    echo 'Full operation: '.$calculator.$cr;
    echo $cr;

    // ----------------------------
    // 2 * 2 ^ 4 = 32
    // ----------------------------
    $result = $calculator->number(2)
        ->operator('*')->number(2)
        ->operator('^')->number(4)
        ->execute();

    echo 'Result: '.$result.$cr;
    echo 'Full operation: '.$calculator.$cr;
    echo $cr;

    // ----------------------------
    // 2 * -2 ^ 4 = -32
    // ----------------------------
    $result = $calculator->number(2)
        ->operator('*')->number(2)->negative()
        ->operator('^')->number(4)
        ->execute();

    echo 'Result: '.$result.$cr;
    echo 'Full operation: '.$calculator.$cr;
    echo $cr;

    // ----------------------------
    // √9 = 3
    // ----------------------------
    $result = $calculator->number(9)
        ->operator('√')
        ->execute();

    echo 'Result: '.$result.$cr;
    echo 'Full operation: '.$calculator.$cr;
    echo $cr;

    // ----------------------------
    // cos(1) = 0.54030230586814
    // ----------------------------
    $result = $calculator->number(1)
        ->operator('cos')
        ->execute();

    echo 'Result: '.$result.$cr;
    echo 'Full operation: '.$calculator.$cr;
    echo $cr;

    // ----------------------------
    // 40! = 102334155
    // ----------------------------
    $result = $calculator->number(40)
        ->operator('!')
        ->execute();

    echo 'Result: '.$result.$cr;
    echo 'Full operation: '.$calculator.$cr;
    echo $cr;

    // ----------------------------
    // 40.32% = 0.4032
    // ----------------------------
    $result = $calculator->number(40.32)
        ->operator('%')
        ->execute();

    echo 'Result: '.$result.$cr;
    echo 'Full operation: '.$calculator.$cr;
    echo $cr;

    // ----------------------------
    // cos(pi / 4) = 0.7071067811865
    // ----------------------------
    $result = $calculator
        ->group(function (Calculator $calculator) {
            $calculator
                ->number('pi')
                ->operator('/')->number(4);
        })
        ->operator('cos')
        ->execute();

    echo 'Result: '.$result.$cr;
    echo 'Full operation: '.$calculator.$cr;
    echo $cr;

} catch (Exception $e) {
    echo 'There was an error: '.$e->getMessage().$cr;
}
