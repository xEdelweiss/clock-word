<?php

namespace xEdelweiss\ClockWord\Tests;

use Carbon\Carbon;
use PHPUnit_Framework_TestCase;
use xEdelweiss\ClockWord\Generator;

class GeneratorTest extends PHPUnit_Framework_TestCase
{
    /** @var Generator */
    protected $generator;

    protected function setUp()
    {
        $this->generator = new Generator();
    }

    public function hoursAndPeriodsProvider()
    {
        $result = [];

        for ($i = 0; $i <= 24; $i++) {
            switch (true) {
                case $i >= 23:
                    $period = Generator::NIGHT;
                    break;
                case $i >= 17:
                    $period = Generator::EVENING;
                    break;
                case $i >= 11:
                    $period = Generator::AFTERNOON;
                    break;
                case $i >= 5:
                    $period = Generator::MORNING;
                    break;
                case $i >= 0:
                    $period = Generator::NIGHT;
                    break;
            }

            $result[] = [Carbon::createFromFormat('H', $i), $period];
        }

        return $result;
    }

    public function periodsTitlesDataProvider()
    {
        return [
            [Generator::MORNING, 'утра'],
            [Generator::AFTERNOON, 'дня'],
            [Generator::EVENING, 'вечера'],
            [Generator::NIGHT, 'ночи'],
        ];
    }

    public function simpleTimeFormatHourProvider()
    {
        return [
            [0, 'двенадцать часов'],
            //[1, 'час'],
            [1, 'один час'],
            [2, 'два часа'],
            [3, 'три часа'],
            [4, 'четыре часа'],
            [5, 'пять часов'],
            [6, 'шесть часов'],
            [7, 'семь часов'],
            [8, 'восемь часов'],
            [9, 'девять часов'],
            [10, 'десять часов'],
            [11, 'одинадцать часов'],
            [12, 'двенадцать часов'],
            //[13, 'час'],
            [13, 'один час'],
            [14, 'два часа'],
            [15, 'три часа'],
            [16, 'четыре часа'],
            [17, 'пять часов'],
            [18, 'шесть часов'],
            [19, 'семь часов'],
            [20, 'восемь часов'],
            [21, 'девять часов'],
            [22, 'десять часов'],
            [23, 'одинадцать часов'],
            [24, 'двенадцать часов'],
        ];
    }

    public function simpleTimeFormatMinuteProvider()
    {
        return [
            [0, 'ноль минут'],
            [1, 'одна минута'],
            [2, 'две минуты'],
            [3, 'три минуты'],
            [4, 'четыре минуты'],
            [5, 'пять минут'],
            [6, 'шесть минут'],
            [7, 'семь минут'],
            [8, 'восемь минут'],
            [9, 'девять минут'],
            [10, 'десять минут'],
            [11, 'одинадцать минут'],
            [12, 'двенадцать минут'],
            [13, 'тринадцать минут'],
            [14, 'четырнадцать минут'],
            [15, 'пятнадцать минут'],
            [16, 'шестнадцать минут'],
            [17, 'семнадцать минут'],
            [18, 'восемнадцать минут'],
            [19, 'девятнадцать минут'],
            [20, 'двадцать минут'],
            [21, 'двадцать одна минута'],
            [22, 'двадцать две минуты'],
            [23, 'двадцать три минуты'],
            [24, 'двадцать четыре минуты'],
            [25, 'двадцать пять минут'],
            [26, 'двадцать шесть минут'],
            [27, 'двадцать семь минут'],
            [28, 'двадцать восемь минут'],
            [29, 'двадцать девять минут'],
            [30, 'тридцать минут'],
            [31, 'тридцать одна минута'],
            [32, 'тридцать две минуты'],
            [33, 'тридцать три минуты'],
            [34, 'тридцать четыре минуты'],
            [35, 'тридцать пять минут'],
            [36, 'тридцать шесть минут'],
            [37, 'тридцать семь минут'],
            [38, 'тридцать восемь минут'],
            [39, 'тридцать девять минут'],
            [40, 'сорок минут'],
            [41, 'сорок одна минута'],
            [42, 'сорок две минуты'],
            [43, 'сорок три минуты'],
            [44, 'сорок четыре минуты'],
            [45, 'сорок пять минут'],
            [46, 'сорок шесть минут'],
            [47, 'сорок семь минут'],
            [48, 'сорок восемь минут'],
            [49, 'сорок девять минут'],
            [50, 'пятьдесят минут'],
            [51, 'пятьдесят одна минута'],
            [52, 'пятьдесят две минуты'],
            [53, 'пятьдесят три минуты'],
            [54, 'пятьдесят четыре минуты'],
            [55, 'пятьдесят пять минут'],
            [56, 'пятьдесят шесть минут'],
            [57, 'пятьдесят семь минут'],
            [58, 'пятьдесят восемь минут'],
            [59, 'пятьдесят девять минут'],
            [60, 'шестьдесят минут'],
        ];
    }

    public function simpleTimeFormatProvider()
    {
        return [
            ['2:00', Generator::TIME_FORMAT_12, 'два часа ноль минут ночи'],
            ['2:00', Generator::TIME_FORMAT_24, 'два часа ноль минут'],
            ['8:12', Generator::TIME_FORMAT_12, 'восемь часов двенадцать минут утра'],
            ['8:12', Generator::TIME_FORMAT_24, 'восемь часов двенадцать минут'],
            ['14:31', Generator::TIME_FORMAT_12, 'два часа тридцать одна минута дня'],
            ['14:31', Generator::TIME_FORMAT_24, 'четырнадцать часов тридцать одна минута'],
            ['17:52', Generator::TIME_FORMAT_12, 'пять часов пятьдесят две минуты вечера'],
            ['17:52', Generator::TIME_FORMAT_24, 'семнадцать часов пятьдесят две минуты'],
            ['23:01', Generator::TIME_FORMAT_12, 'одинадцать часов одна минута ночи'],
            ['23:01', Generator::TIME_FORMAT_24, 'двадцать три часа одна минута'],
        ];
    }

    public function testGenerator()
    {
        $this->assertInstanceOf(Generator::class, $this->generator);
    }

    /**
     * @dataProvider hoursAndPeriodsProvider
     */
    public function testPeriodOfDay($time, $expectedPeriod)
    {
        $actualPeriod = $this->generator->getPeriodOfDay($time);
        $this->assertEquals($expectedPeriod, $actualPeriod);
    }

    /**
     * @dataProvider periodsTitlesDataProvider
     */
    public function testStringifyPeriodOfDay($period, $expectedTitle)
    {
        $actualTitle = $this->generator->stringifyPeriodOfDay($period);
        $this->assertEquals($expectedTitle, $actualTitle);
    }

    /**
     * @dataProvider simpleTimeFormatHourProvider
     */
    public function testStringifyHour($hour, $expectedResult)
    {
        $actualResult = $this->generator->stringifyHour($hour);

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @dataProvider simpleTimeFormatMinuteProvider
     */
    public function testStringifyMinute($minute, $expectedResult)
    {
        $actualResult = $this->generator->stringifyMinute($minute);

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @dataProvider simpleTimeFormatProvider
     */
    public function testStringifyTime($time, $timeFormat, $expectedResult)
    {
        $actualResult = $this->generator->stringifyTime(Carbon::createFromFormat('H:i', $time), $timeFormat);

        $this->assertEquals($expectedResult, $actualResult);
    }
}