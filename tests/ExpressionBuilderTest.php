<?php


use App\Expression\ExpressionInterface;
use App\Operator\Minus;
use App\Operator\Plus;
use PHPUnit\Framework\TestCase;
use App\ExpressionBuilder;
use App\Operators;



class ExpressionBuilderTest extends TestCase
{

    /**
     * @dataProvider builderData
     */
    public function testBuilder($rawExpression)
    {
        $operators = new Operators();
        $operators->add(new Plus());
        $operators->add(new Minus());

        $expressionBuilder = new ExpressionBuilder($operators);

        $expression = $expressionBuilder->build($rawExpression);
        $this->assertTrue($expression instanceof ExpressionInterface);
    }



    public function builderData()
    {
        return [
            [[1, '+', 2, '+', [10, '-', 4]]],
            [[1, '+', 2]],
            [[1]],
            [['-', 1]],
            [['+', 1]],
        ];
    }


}
