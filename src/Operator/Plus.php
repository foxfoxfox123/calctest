<?php

namespace App\Operator;


class Plus extends AbstractOperator implements OperatorBinaryInterface, OperatorUnaryInterface
{

    protected $operator = '+';

    protected $priority = 1000;


    public function apply ($left, $right)
    {
        return $left + $right;
    }


    public function applyUnary ($value)
    {
        return $value;
    }

}