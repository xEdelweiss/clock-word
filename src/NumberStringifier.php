<?php

namespace xEdelweiss\ClockWord;

/**
 * Class NumberStringifier
 * @package xEdelweiss\ClockWord
 *
 * Supports only [0;60] range
 */
class NumberStringifier
{
    protected $map = [
        '0' => 'ноль',
        '1' => 'один',
        '2' => 'два',
        '3' => 'три',
        '4' => 'четыре',
        '5' => 'пять',
        '6' => 'шесть',
        '7' => 'семь',
        '8' => 'восемь',
        '9' => 'девять',
        '10' => 'десять',
        '11' => 'одинадцать',
        '12' => 'двенадцать',
        '13' => 'тринадцать',
        '14' => 'четырнадцать',
        '15' => 'пятнадцать',
        '16' => 'шестнадцать',
        '17' => 'семнадцать',
        '18' => 'восемнадцать',
        '19' => 'девятнадцать',
        '2(?P<digit>\d)' => 'двадцать',
        '3(?P<digit>\d)' => 'тридцать',
        '4(?P<digit>\d)' => 'сорок',
        '5(?P<digit>\d)' => 'пятьдесят',
        '6(?P<digit>\d)' => 'шестьдесят', // да и 60 нам тут не понадобится
    ];

    /**
     * @param int $number
     * @return string
     */
    public function stringify($number) {
        foreach ($this->map as $pattern => $string) {
            if (!preg_match("/^{$pattern}$/", $number, $matches)) {
                continue;
            }

            $result = $string;
            break;
        }

        if (isset($matches['digit']) && $matches['digit'] != '0') {
            $result .= ' ' . $this->stringify($matches['digit']);
        }

        return $result;
    }
}