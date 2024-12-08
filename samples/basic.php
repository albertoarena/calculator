#!/usr/bin/php
<?php

chdir(dirname(__DIR__));
require './vendor/autoload.php';

$cli = 'cli' === php_sapi_name() || defined('STDIN');
$cr = $cli ? "\n" : '<br>';

use Calculator\Calculator;

$calculator = new Calculator;

try {

    // 1 + 5 * 3.5 / 2 = 9.75
    $result = $calculator->number(1)
        ->operator('+')->number(5)
        ->operator('*')->number(3.5)
        ->operator('/')->number(2)
        ->execute();

    echo 'Result: '.$result.$cr;
    echo 'Full operation: '.$calculator.$cr;
    echo $cr;

    $result = $calculator->number(2)
        ->operator('*')->number(2)
        ->operator('^')->number(4)
        ->execute();

    echo 'Result: '.$result.$cr;
    echo 'Full operation: '.$calculator.$cr;
    echo $cr;

    $result = $calculator->number(2)
        ->operator('*')->number(2)->negative()
        ->operator('^')->number(4)
        ->execute();

    echo 'Result: '.$result.$cr;
    echo 'Full operation: '.$calculator.$cr;
    echo $cr;

    $result = $calculator->number(9)
        ->operator('√')
        ->execute();

    echo 'Result: '.$result.$cr;
    echo 'Full operation: '.$calculator.$cr;
    echo $cr;

    $result = $calculator->number(1)
        ->operator('cos')
        ->execute();

    echo 'Result: '.$result.$cr;
    echo 'Full operation: '.$calculator.$cr;
    echo $cr;

} catch (Exception $e) {
    echo 'There was an error: '.$e->getMessage().$cr;
}
