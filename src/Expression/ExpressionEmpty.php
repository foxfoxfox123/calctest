<?php


namespace App\Expression;


use App\operator\OperatorInterface;


class ExpressionEmpty implements ExpressionInterface
{


    /**
     * @var float|int|ExpressionInterface
     */
    protected $value;


    /**
     * Expression constructor.
     * @param ExpressionInterface|float|int $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }


    /**
     * @return float|int
     */
    public function match()
    {
        $value = $this->value instanceof ExpressionInterface ? $this->value->match() : $this->value;
        return $value;
    }


    /**
     * @return float|int|ExpressionInterface
     */
    public function getValue()
    {
        return $this->value;
    }


}