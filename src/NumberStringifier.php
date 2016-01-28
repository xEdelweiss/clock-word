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
    const MALE = 'male';
    const FEMALE = 'female';

    protected $map = [
        '0' => ['ноль'],
        '1' => ['один', 'одна'],
        '2' => ['два', 'две'],
        '3' => ['три'],
        '4' => ['четыре'],
        '5' => ['пять'],
        '6' => ['шесть'],
        '7' => ['семь'],
        '8' => ['восемь'],
        '9' => ['девять'],
        '10' => ['десять'],
        '11' => ['одинадцать'],
        '12' => ['двенадцать'],
        '13' => ['тринадцать'],
        '14' => ['четырнадцать'],
        '15' => ['пятнадцать'],
        '16' => ['шестнадцать'],
        '17' => ['семнадцать'],
        '18' => ['восемнадцать'],
        '19' => ['девятнадцать'],
        '2(?P<digit>\d)' => ['двадцать'],
        '3(?P<digit>\d)' => ['тридцать'],
        '4(?P<digit>\d)' => ['сорок'],
        '5(?P<digit>\d)' => ['пятьдесят'],
        '6(?P<digit>\d)' => ['шестьдесят'], // да и 60 нам тут не понадобится
    ];

    /**
     * @param int $number
     * @return string
     */
    public function stringify($number, $gender = self::MALE) {
        foreach ($this->map as $pattern => $strings) {
            if (!preg_match("/^{$pattern}$/", $number, $matches)) {
                continue;
            }

            $string = $gender == self::FEMALE && isset($strings[1])
                ? $strings[1]
                : $strings[0];

            $result = $string;
            break;
        }

        if (isset($matches['digit']) && $matches['digit'] != '0') {
            $result .= ' ' . $this->stringify($matches['digit'], $gender);
        }

        return $result;
    }
}