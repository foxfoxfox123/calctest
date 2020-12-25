<?php

namespace App;

use App\Operator\OperatorInterface;


class Operators
{

    const TYPE_UNARY = 'unary';
    const TYPE_BINARY = 'binary';


    /**
     * @var OperatorInterface[]
     */
    protected array $operators = [];


    /**
     * @param OperatorInterface $operator
     */
    public function add(OperatorInterface $operator)
    {
        $this->operators[] = $operator;
    }


    /**
     * @param string $rawOperator
     * @param string $type
     * @return int|null
     */
    public function getPriority(string $rawOperator, string $type = self::TYPE_BINARY): ?int
    {
        foreach ($this->operators as $operator) {
            if ($operator->getOperator() == $rawOperator) {
                return $operator->getPriority();
            }
        }

        return null;
    }


    /**
     * @param string $rawOperator
     * @param string $type
     * @return OperatorInterface|null
     */
    public function getOperator(string $rawOperator, string $type = self::TYPE_BINARY): ?OperatorInterface
    {
        foreach ($this->operators as $operator) {
            if ($operator->getOperator() == $rawOperator) {
                return $operator;
            }
        }

        return null;
    }




}