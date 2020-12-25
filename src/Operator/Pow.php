<?php

namespace App\Operator;


class Pow extends AbstractOperator implements OperatorBinaryInterface
{

    protected $operator = '^';

    protected $priority = 10000;


    public function apply ($left, $right)
    {
        return pow($left, $right);
    }

}