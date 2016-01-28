# Clock Word

Нет времени объяснять :)

```php
$generator = new \xEdelweiss\ClockWord\Generator();
$time = \Carbon\Carbon::createFromFormat('H:i', '17:48');

$generator->stringifyTime($time); // пять часов сорок восемь минут вечера
```

## Благодарность
- Brian Nesbitt за Carbon, A simple PHP API extension for DateTime (https://github.com/Intervention/image)
- Sebastian Bergmann за PHPUnit, The PHP Unit Testing framework (https://github.com/sebastianbergmann/phpunit)
- Symfony за VarDumper, The VarDumper Component (https://github.com/symfony/var-dumper)
