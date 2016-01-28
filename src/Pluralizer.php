<?php

namespace xEdelweiss\ClockWord;

class Pluralizer
{
    const ONE = 'one';
    const FEW = 'few';
    const MANY = 'many';
    const OTHER = 'other';

    /**
     * @param $count
     * @param $words
     */
    public function make($count, $words)
    {
        $category = $this->getCategory($count);

        if (!isset($words[$category])) {
            throw new \Exception("Provide [{$category}] variant of word [" . json_encode($words) . "]");
        }

        return $words[$category];
    }

    protected function getCategory($count)
    {
        $mod10  = $count % 10;
        $mod100 = $count % 100;

        if (is_int($count) && $mod10 == 1 && $mod100 != 11) {
            return self::ONE;
        } elseif (($mod10 > 1 && $mod10 < 5) && ($mod100 < 12 || $mod100 > 14)) {
            return self::FEW;
        } elseif ($mod10 == 0 || ($mod10 > 4 && $mod10 < 10) || ($mod100 > 10 && $mod100 < 15)) {
            return self::MANY;
        } else {
            return self::OTHER;
        }
    }
}