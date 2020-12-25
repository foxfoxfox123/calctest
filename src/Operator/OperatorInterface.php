<?php


namespace App\Operator;


interface OperatorInterface
{

    public function getOperator();

    public function getPriority();

    public function apply ($left, $right);

}