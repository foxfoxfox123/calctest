<?php

use App\Calculator;
use App\ExpressionBuilder;
use App\Operator\Division;
use App\Operator\Minus;
use App\Operator\Multiply;
use App\Operator\Plus;
use App\Operator\Pow;
use App\Operators;
use PHPUnit\Framework\TestCase;
use App\Parser;


class CalculatorTest extends TestCase
{


    /**
     * @dataProvider calcData
     */
    public function testParserApp ($calc, $expected)
    {
        $operators = new Operators();
        $operators->add(new Plus());
        $operators->add(new Minus());
        $operators->add(new Division());
        $operators->add(new Multiply());
        $operators->add(new Pow());

        $parser = new Parser();
        $expressionBuilder = new ExpressionBuilder($operators);

        $calculator = new Calculator($parser, $expressionBuilder);
        $this->assertEquals($calculator->calc($calc), $expected);
    }


    public function calcData()
    {
        return [
            [
                'expression' => '(1 + 2) + (1 + 3)',
                'expected' => 7
            ],
            [
                'expression' => '(2 + (1 + 2)) + (1 + 3)',
                'expected' => 9
            ],
            [
                'expression' => '(2.3 + (1 + 2)) + (1 + 3)',
                'expected' => 9.3
            ],
            [
                'expression' => '(2.3)',
                'expected' => 2.3
            ],
            [
                'expression' => '(2.3 * 10)',
                'expected' => 23
            ],
            [
                'expression' => '1 + 230 / (2.3 * 10)',
                'expected' => 11
            ],
            [
                'expression' => '1 + 2^3',
                'expected' => 9
            ],
            [
                'expression' => '-10',
                'expected' => -10
            ],
            [
                'expression' => '-10 + 5',
                'expected' => -5
            ],
            [
                'expression' => '-(-10)',
                'expected' => 10
            ]
        ];
    }

}
