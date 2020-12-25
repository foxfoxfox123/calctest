<?php

use App\Calculator;
use App\ExpressionBuilder;
use App\Operator\Division;
use App\Operator\Minus;
use App\Operator\Multiply;
use App\Operator\Plus;
use App\Operator\Pow;
use App\Operators;
use App\Parser;


require __DIR__ . '/vendor/autoload.php';

$operators = new Operators();
$operators->add(new Plus());
$operators->add(new Minus());
$operators->add(new Division());
$operators->add(new Multiply());
$operators->add(new Pow());

$parser = new Parser();
$expressionBuilder = new ExpressionBuilder($operators);

$calc = implode(' ', array_slice($argv, 1));


$calculator = new Calculator($parser, $expressionBuilder);

try {
    print PHP_EOL . 'Result: ' . $calculator->calc($calc) . PHP_EOL;
} catch (Exception $e) {
    print $e->getMessage();
}