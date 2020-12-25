<?php


namespace App\Expression;


use App\operator\OperatorUnaryInterface;


class ExpressionUnary implements ExpressionInterface
{


    /**
     * @var float|int|ExpressionInterface
     */
    protected $value;

    /**
     * @var OperatorUnaryInterface
     */
    protected OperatorUnaryInterface $operator;


    /**
     * Expression constructor.
     * @param OperatorUnaryInterface $operator
     * @param ExpressionInterface|float|int $value
     */
    public function __construct(OperatorUnaryInterface $operator, $value)
    {
        $this->operator = $operator;
        $this->value = $value;
    }


    /**
     * @return float|int
     */
    public function match()
    {
        $value = $this->value instanceof ExpressionInterface ? $this->value->match() : $this->value;
        return $this->operator->applyUnary($value);
    }


    /**
     * @return ExpressionInterface|float|int
     */
    public function getValue()
    {
        return $this->value;
    }


}