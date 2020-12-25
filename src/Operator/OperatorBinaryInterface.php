<?php


namespace App\Operator;


interface OperatorBinaryInterface
{

    public function apply ($left, $right);

}