<?php

require 'vendor/autoload.php';

$g = new \xEdelweiss\ClockWord\Generator();
dump($g->stringifyTime(\Carbon\Carbon::createFromFormat('H:i', '13:30')));