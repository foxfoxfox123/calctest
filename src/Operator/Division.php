<?php

namespace App\Operator;


class Division extends AbstractOperator implements OperatorBinaryInterface
{

    protected $operator = '/';

    protected $priority = 7000;


    public function apply ($left, $right)
    {
        return $left / $right;
    }

}