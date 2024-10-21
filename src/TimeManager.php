<?php


namespace pixelwhiz\times;

use pixelwhiz\times\math\DayRange;
use pocketmine\world\World;

class TimeManager {

    public static function getCurrentDay(World $world): string {
        $dayRanges = [
            DayRange::SUNDAY,
            DayRange::MONDAY,
            DayRange::TUESDAY,
            DayRange::WEDNESDAY,
            DayRange::THURSDAY,
            DayRange::FRIDAY,
            DayRange::SATURDAY,
        ];

        $time = $world->getTime();

        foreach ($dayRanges as $index => $ranges) {
            for ($i = 0; $i < count($ranges); $i += 2) {
                if ($time >= $ranges[$i] && $time < $ranges[$i + 1]) {
                    return DayRange::DAYS[$index];
                }
            }
        }

        if ($time >= 168000) {
            $world->setTime(0);
        }

        return "Sunday";
    }

    public static function getCurrentTime(World $world): string {
        return $day = self::getCurrentDay($world);
    }

}