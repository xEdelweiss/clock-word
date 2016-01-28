<?php

namespace xEdelweiss\ClockWord;

use Carbon\Carbon;

class Generator
{
    const NIGHT = 'night';
    const MORNING = 'morning';
    const AFTERNOON = 'afternoon'; // да-да, это не совсем afternoon
    const EVENING = 'evening';

    protected $dayStructure = [
        0 => self::NIGHT,
        5 => self::MORNING,
        11 => self::AFTERNOON,
        17 => self::EVENING,
        23 => self::NIGHT,
    ];

    /**
     * @param Carbon $time
     */
    public function make(Carbon $time)
    {

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