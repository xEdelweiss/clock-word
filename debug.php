<?php

require 'vendor/autoload.php';

$ds = new \xEdelweiss\ClockWord\NumberStringifier();

for ($i = 0; $i <= 60; $i++) {
    $result = $ds->stringify($i);
    echo ("[$i, '$result'],") . PHP_EOL;
}