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

    public function simpleTimeFormatHoursProvider()
    {
        return [
            [0, 'двенадцать часов'],
            [1, 'час'],
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
            [13, 'час'],
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
     * @dataProvider simpleTimeFormatHoursProvider
     */
    public function testStringifyHour($hour, $expectedResult)
    {
        $actualResult = $this->generator->stringifyHour($hour);

        $this->assertEquals($expectedResult, $actualResult);
    }
}