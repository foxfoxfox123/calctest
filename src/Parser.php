<?php


namespace App;


class Parser
{


    /**
     * Parse string to tree with numbers and operators
     *
     * @param string $string
     * @return array
     */
    public function parse(string $string): array
    {
        $string = preg_replace('/\s+/is', '', $string);
        $placeholders = [];

        // Для упрощения ищем выражения в скобках и заменяем их на плейсхолеры
        while (preg_match_all('/\(([^()]+)\)/is', $string, $matched)) {
            foreach ($matched[1] as $k => $match) {
                $placeholders[] = $match;
                $string = str_replace($matched[0][$k], '$' . (count($placeholders) - 1), $string);
            }
        }

        return $this->parseString($string, $placeholders);
    }



    /**
     * @param string $string
     * @param $placeholders
     * @return array
     */
    protected function parseString(string $string, $placeholders): array
    {
        $parsed = [];

        for ($i = 0; $i < strlen($string); $i++) {
            if (is_numeric($string[$i])) {
                $number = floatval(substr($string, $i));
                $parsed[] = $number;
                $i += strlen($number);
                if (!isset($string[$i])) {
                    break;
                }
            }

            if ($string[$i] == '$') {
                $placeholderIndex = intval(substr($string, $i + 1));
                $parsed[] = $this->parseString($placeholders[$placeholderIndex], $placeholders);
                $i += strlen($placeholderIndex) + 1;
                if (!isset($string[$i])) {
                    break;
                }
            }

            $parsed[] = $string[$i];
        }

        return $parsed;
    }




}