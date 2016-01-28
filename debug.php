<?php

require 'vendor/autoload.php';

$generator = new \xEdelweiss\ClockWord\Generator();
$time = \Carbon\Carbon::createFromFormat('H:i', '17:48');

echo $generator->stringifyTime($time); // пять часов сорок восемь минут вечера