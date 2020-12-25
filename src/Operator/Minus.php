<?php

namespace App\Operator;


class Minus extends AbstractOperator implements OperatorBinaryInterface, OperatorUnaryInterface
{

    protected $operator = '-';

    protected $priority = 2000;


    public function apply ($left, $right)
    {
        return $left - $right;
    }

    public function applyUnary ($value)
    {
        return -1 * $value;
    }

}