<?php

namespace xEdelweiss\ClockWord\Tests;

use Carbon\Carbon;
use PHPUnit_Framework_TestCase;
use xEdelweiss\ClockWord\Generator;

class SimpleTest extends PHPUnit_Framework_TestCase
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

    public function simpleTimeFormatHoursProvider()
    {
        return [
            ['0:00', 'двенадцать часов ночи'],
            ['1:00', 'час ночи'],
            ['2:00', 'два часа ночи'],
            ['3:00', 'три часа ночи'],
            ['4:00', 'четыре часа ночи'],
            ['5:00', 'пять часов утра'],
            ['6:00', 'шесть часов утра'],
            ['7:00', 'семь часов утра'],
            ['8:00', 'восемь часов утра'],
            ['9:00', 'девять часов утра'],
            ['10:00', 'десять часов утра'],
            ['11:00', 'одинадцать часов дня'],
            ['12:00', 'двенадцать часов дня'],
            ['13:00', 'час дня'],
            ['14:00', 'два часа дня'],
            ['15:00', 'три часа дня'],
            ['16:00', 'четыре часа дня'],
            ['17:00', 'пять часов вечера'],
            ['18:00', 'три часа вечера'],
            ['19:00', 'три часа вечера'],
            ['20:00', 'восемь часов вечера'],
            ['21:00', 'восемь часов вечера'],
            ['22:00', 'десять часов ночи'],
            ['23:00', 'одинадцать часов ночи'],
            ['24:00', 'двенадцать часов ночи'],
        ];
    }

    public function testGenerator()
    {
        $this->assertInstanceOf(Generator::class, $this->generator);
        $this->assertTrue(method_exists($this->generator, 'make'), 'Method [make] doesn\'t exist in ' . Generator::class);
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
     * @dataProvider simpleTimeFormatHoursProvider
     */
    public function testHoursFormatting($timeString, $expectedResult)
    {
        $time = Carbon::createFromFormat('H:i', $timeString);

        $actualResult = $this->generator->make($time);

        $this->assertEquals($expectedResult, $actualResult);
    }
}