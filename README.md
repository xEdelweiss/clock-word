# Clock Word

Нет времени объяснять :)

```php
$generator = new \xEdelweiss\ClockWord\Generator();
$time = \Carbon\Carbon::createFromFormat('H:i', '17:48');

$generator->stringifyTime($time); // пять часов сорок восемь минут вечера
```
