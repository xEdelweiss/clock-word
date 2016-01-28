<?php

namespace xEdelweiss\ClockWord;

use Carbon\Carbon;

class Generator
{
    const NIGHT = 'night';
    const MORNING = 'morning';
    const AFTERNOON = 'afternoon'; // да-да, это не совсем afternoon
    const EVENING = 'evening';

    const TIME_FORMAT_24 = '24';
    const TIME_FORMAT_12 = '12';

    protected $dayStructure = [
        0 => self::NIGHT,
        5 => self::MORNING,
        11 => self::AFTERNOON,
        17 => self::EVENING,
        23 => self::NIGHT,
    ];

    protected $hourPluralization = [
        Pluralizer::ONE => 'час',
        Pluralizer::FEW => 'часа',
        Pluralizer::MANY => 'часов',
    ];

    /**
     * @var array
     * use $value instead of $key
     * @see stringifyHour
     */
    protected $hourOverride = [
        0 => 12,
    ];

    protected $skipHourTitle = [1];

    /**
     * @param int $hour
     */
    public function stringifyHour($hour, $timeFormat = self::TIME_FORMAT_12)
    {
        $result = [];
        $numberStringifier = new NumberStringifier();
        $pluralizer = new Pluralizer();

        if ($timeFormat == self::TIME_FORMAT_12) {
            $hour %= 12;
        }

        if (isset($this->hourOverride[$hour])) {
            $hour = $this->hourOverride[$hour];
        }

        $hourString = $numberStringifier->stringify($hour);

        if (!in_array($hour, $this->skipHourTitle)) {
            $result[] = $hourString;
        }

        $result[] = $pluralizer->make($hour, $this->hourPluralization);

        return join(' ', $result);
    }

    /**
     * @param Carbon $time
     * @return null|string
     * @throws \Exception
     */
    public function getPeriodOfDay(Carbon $time)
    {
        $result = null;
        $hour = $time->hour;

        foreach ($this->getDayStructure() as $fromHour => $period) {
            if ($hour >= $fromHour) {
                $result = $period;
                continue;
            }

            break;
        }

        if (is_null($result)) {
            throw new \Exception('Invalid day structure');
        }

        return $result;
    }

    /**
     * @return array
     */
    public function getDayStructure()
    {
        return $this->dayStructure;
    }

    /**
     * @param array $dayStructure
     */
    public function setDayStructure($dayStructure)
    {
        $this->dayStructure = $dayStructure;
    }
}