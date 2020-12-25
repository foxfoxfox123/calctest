<?php


namespace App\Expression;


interface ExpressionInterface
{
    /**
     * @return float|int
     */
    public function match();


}