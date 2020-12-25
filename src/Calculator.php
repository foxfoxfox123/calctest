<?php


namespace App;


class Calculator
{

    /**
     * @var Parser
     */
    protected Parser $parser;

    /**
     * @var ExpressionBuilder
     */
    protected ExpressionBuilder $expressionBuilder;


    public function __construct(Parser $parser, ExpressionBuilder $expressionBuilder)
    {
        $this->parser = $parser;
        $this->expressionBuilder = $expressionBuilder;
    }


    /**
     * @param string $calc
     * @return float|int
     */
    public function calc(string $calc)
    {
        $rawExpressions = $this->parser->parse($calc);
        $expression = $this->expressionBuilder->build($rawExpressions);

        return $expression->match();
    }

}