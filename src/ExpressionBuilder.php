<?php


namespace App;

use App\Expression\Expression;
use App\Expression\ExpressionUnary;
use App\Expression\ExpressionEmpty;
use App\Exception\UnsupportedOperator;
use App\Expression\ExpressionInterface;

class ExpressionBuilder
{


    /**
     * @var Operators
     */
    public $operators;


    public function __construct(Operators $operators)
    {
        $this->operators = $operators;
    }


    /**
     * @param array $rawExpressions
     * @return ExpressionInterface
     */
    public function build (array $rawExpressions)
    {
        foreach ($rawExpressions as $key => $rawExpression) {
            if (is_array($rawExpression)) {
                $rawExpressions[$key] = $this->build($rawExpression);
            }
        }


        while (count($rawExpressions) > 1) {
            $operatorIndex = $this->getOperatorIndexWithMaxPriority($rawExpressions);
            if ($operatorIndex === null) {
                break;
            }

            $rawExpressions = $this->replaceWithExpression($rawExpressions, $operatorIndex);
        }

        $expression = current($rawExpressions);
        if (is_scalar($expression)) {
            $expression = new ExpressionEmpty($expression);
        }

        return $expression;
    }


    /**
     * @param array $rawExpressions
     * @param int $operatorIndex
     * @return array
     * @throws UnsupportedOperator
     */
    protected function replaceWithExpression(array $rawExpressions, int $operatorIndex): array
    {
        $operatorType = !isset($rawExpressions[$operatorIndex - 1]) ? Operators::TYPE_UNARY : Operators::TYPE_BINARY;
        $operator = $this->operators->getOperator($rawExpressions[$operatorIndex], $operatorType);
        if (!$operator) {
            throw new UnsupportedOperator();
        }

        if (!isset($rawExpressions[$operatorIndex - 1])) {
            $expression = new ExpressionUnary($operator, $rawExpressions[$operatorIndex + 1]);
            array_splice($rawExpressions, $operatorIndex, 2, [$expression]);
        } else {
            $expression = new Expression($operator, $rawExpressions[$operatorIndex - 1], $rawExpressions[$operatorIndex + 1]);;
            array_splice($rawExpressions, $operatorIndex - 1, 3, [$expression]);
        }

        return $rawExpressions;
    }


    /**
     * @param array $rawExpressions
     * @return int|null
     * @throws UnsupportedOperator
     */
    protected function getOperatorIndexWithMaxPriority(array $rawExpressions): ?int
    {
        $maxPriorityIndex = null;
        $maxPriority = null;

        foreach ($rawExpressions as $key => $rawExpression) {
            if (!is_numeric($rawExpression) && is_scalar($rawExpression)) {
                $operatorType = !isset($rawExpressions[$key - 1]) ? Operators::TYPE_UNARY : Operators::TYPE_BINARY;
                $priority = $this->operators->getPriority($rawExpression, $operatorType);
                if ($priority === null) {
                    throw new UnsupportedOperator();
                }

                if ($priority > $maxPriority) {
                    $maxPriority = $priority;
                    $maxPriorityIndex = $key;
                }
            }
        }

        return $maxPriorityIndex;
    }


    /**
     * @param array $rawExpressions
     * @return array
     */
    protected function replaceLeadingOperator(array $rawExpressions): array
    {
        if (!is_numeric($rawExpressions[0]) && is_scalar($rawExpressions[0])) {
            $rawExpressions[1] *= $rawExpressions[0] == '-' ? -1 : 1;
            unset($rawExpressions[0]);
        }

        return $rawExpressions;
    }


}