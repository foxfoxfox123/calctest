<?php

namespace App\Operator;


class Multiply extends AbstractOperator implements OperatorBinaryInterface
{

    protected $operator = '*';

    protected $priority = 5000;


    public function apply ($left, $right)
    {
        return $left * $right;
    }

}