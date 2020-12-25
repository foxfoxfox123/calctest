<?php

use PHPUnit\Framework\TestCase;
use App\Parser;


class ParserTest extends TestCase
{


    /**
     * @dataProvider parserData
     */
    public function testParserApp ($expression, $expected)
    {
        $calculator = new Parser();

        $this->assertEquals($calculator->parse($expression), $expected);
    }


    public function parserData()
    {
        return [
            [
                'expression' => '(1 + 2) + (1 + 3)',
                'expected' => [
                    [1, '+', 2],
                    '+',
                    [1, '+', 3]
                ]
            ],
            [
                'expression' => '(2 + (1 + 2)) + (1 + 3)',
                'expected' => [
                    [2, '+', [1, '+', 2]],
                    '+',
                    [1, '+', 3]
                ]
            ],
            [
                'expression' => '(2.3 + (1 + 2)) + (1 + 3)',
                'expected' => [
                    [2.3, '+', [1, '+', 2]],
                    '+',
                    [1, '+', 3]
                ]
            ]
        ];
    }

}
