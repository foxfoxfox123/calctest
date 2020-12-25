<?php


namespace App\Operator;

use App\Expression\Expression;


abstract class AbstractOperator implements OperatorInterface
{

    /**
     * @var null|string
     */
    protected $operator = null;

    /**
     * @var int
     */
    protected $priority = 0;


    /**
     * @return string
     * @throws \Exception
     */
    public function getOperator(): string
    {
        if (empty($this->operator)) {
            throw new \Exception('Operator is not  defined');
        }

        return $this->operator;
    }


    /**
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }



}