<?php

require 'vendor/autoload.php';

$time = \Carbon\Carbon::createFromFormat('H:i', '0:00');
$generator = new \xEdelweiss\ClockWord\Generator();

for ($i = 0; $i <= 24*60; $i++) {
    echo $time->format('H:i') . PHP_EOL;
    echo ' - ' . $generator->stringifyTime($time) . PHP_EOL;
    echo ' - ' . $generator->stringifyTime($time, \xEdelweiss\ClockWord\Generator::TIME_FORMAT_24) . PHP_EOL;
    $time->addMinute();
}