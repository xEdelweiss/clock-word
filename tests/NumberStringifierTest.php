<?php

namespace xEdelweiss\ClockWord\Tests;

use PHPUnit_Framework_TestCase;
use xEdelweiss\ClockWord\NumberStringifier;

class NumberStringifierTest extends PHPUnit_Framework_TestCase
{
    /** @var NumberStringifier */
    protected $stringifier;

    protected function setUp()
    {
        $this->stringifier = new NumberStringifier();
    }

    public function numbersDataProvider()
    {
        return [
            [0, 'ноль'],
            [1, 'один'],
            [2, 'два'],
            [3, 'три'],
            [4, 'четыре'],
            [5, 'пять'],
            [6, 'шесть'],
            [7, 'семь'],
            [8, 'восемь'],
            [9, 'девять'],
            [10, 'десять'],
            [11, 'одинадцать'],
            [12, 'двенадцать'],
            [13, 'тринадцать'],
            [14, 'четырнадцать'],
            [15, 'пятнадцать'],
            [16, 'шестнадцать'],
            [17, 'семнадцать'],
            [18, 'восемнадцать'],
            [19, 'девятнадцать'],
            [20, 'двадцать'],
            [21, 'двадцать один'],
            [22, 'двадцать два'],
            [23, 'двадцать три'],
            [24, 'двадцать четыре'],
            [25, 'двадцать пять'],
            [26, 'двадцать шесть'],
            [27, 'двадцать семь'],
            [28, 'двадцать восемь'],
            [29, 'двадцать девять'],
            [30, 'тридцать'],
            [31, 'тридцать один'],
            [32, 'тридцать два'],
            [33, 'тридцать три'],
            [34, 'тридцать четыре'],
            [35, 'тридцать пять'],
            [36, 'тридцать шесть'],
            [37, 'тридцать семь'],
            [38, 'тридцать восемь'],
            [39, 'тридцать девять'],
            [40, 'сорок'],
            [41, 'сорок один'],
            [42, 'сорок два'],
            [43, 'сорок три'],
            [44, 'сорок четыре'],
            [45, 'сорок пять'],
            [46, 'сорок шесть'],
            [47, 'сорок семь'],
            [48, 'сорок восемь'],
            [49, 'сорок девять'],
            [50, 'пятьдесят'],
            [51, 'пятьдесят один'],
            [52, 'пятьдесят два'],
            [53, 'пятьдесят три'],
            [54, 'пятьдесят четыре'],
            [55, 'пятьдесят пять'],
            [56, 'пятьдесят шесть'],
            [57, 'пятьдесят семь'],
            [58, 'пятьдесят восемь'],
            [59, 'пятьдесят девять'],
            [60, 'шестьдесят'],
        ];
    }

    /**
     * @dataProvider numbersDataProvider
     */
    public function testStringify($hour, $expectedResult)
    {
        $actualResult = $this->stringifier->stringify($hour);
        $this->assertEquals($expectedResult, $actualResult);
    }
}