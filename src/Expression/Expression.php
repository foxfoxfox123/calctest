<?php


namespace App\Expression;


use App\operator\OperatorBinaryInterface;


class Expression implements ExpressionInterface
{


    /**
     * @var float|int|ExpressionInterface
     */
    protected $left;

    /**
     * @var float|int|ExpressionInterface
     */
    protected $right;

    /**
     * @var OperatorBinaryInterface
     */
    protected OperatorBinaryInterface $operator;


    /**
     * Expression constructor.
     * @param OperatorBinaryInterface $operator
     * @param $left
     * @param $right
     */
    public function __construct(OperatorBinaryInterface $operator, $left, $right)
    {
        $this->operator = $operator;
        $this->left = $left;
        $this->right = $right;
    }


    /**
     * @return float|int
     */
    public function match()
    {
        $left = $this->left instanceof ExpressionInterface ? $this->left->match() : $this->left;
        $right = $this->right instanceof ExpressionInterface ? $this->right->match() : $this->right;

        return $this->operator->apply($left, $right);
    }


    /**
     * @return ExpressionInterface|float|int
     */
    public function getLeft()
    {
        return $this->left;
    }

    /**
     * @return ExpressionInterface|float|int
     */
    public function getRight()
    {
        return $this->right;
    }

}