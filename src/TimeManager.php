<?php

/*
 *   _______ _
 *  |__   __(_)
 *     | |   _ _ __ ___   ___  ___
 *     | |  | | '_ ` _ \ / _ \/ __|
 *     | |  | | | | | | |  __/\__ \
 *     |_|  |_|_| |_| |_|\___||___/
 *
 * Copyright (C) 2024 pixelwhiz
 *
 * This software is distributed under "GNU General Public License v3.0".
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License v3.0
 * along with this program. If not, see <https://opensource.org/licenses/GPL-3.0>.
 */


namespace pixelwhiz\times;

use pixelwhiz\times\math\DayRange;
use pixelwhiz\times\math\Time;
use pocketmine\world\World;

class TimeManager {

    /**
     * @param World $world
     * @return string
     */
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


    /**
     * @param string $day
     * @return array
     */
    public static function rangeOfDay(string $day): array {
        $index = array_search($day, DayRange::DAYS);
        if ($index === false) {
            throw new \InvalidArgumentException("Invalid day: $day");
        }

        switch ($index) {
            case 0:
                return DayRange::SUNDAY;
            case 1:
                return DayRange::MONDAY;
            case 2:
                return DayRange::TUESDAY;
            case 3:
                return DayRange::WEDNESDAY;
            case 4:
                return DayRange::THURSDAY;
            case 5:
                return DayRange::FRIDAY;
            case 6:
                return DayRange::SATURDAY;
            default:
                throw new \OutOfBoundsException("Invalid index: $index");
        }
    }

    /**
     * @param World $world
     * @return string
     */
    public static function getCurrentTime(World $world): string {
        if (self::getCurrentDay($world) === DayRange::DAYS[0]) {
            $worldTime = floatval($world->getTime());
            if ($worldTime >= DayRange::SUNDAY[2] and $worldTime < DayRange::SUNDAY[3]) {
                $time = ($worldTime - DayRange::SUNDAY[2]) * 0.06;
                $time = round($time);
                return Time::format(gmdate("i:s", $time), $time);
            } else if ($worldTime >= DayRange::SUNDAY[0] and $worldTime < DayRange::SUNDAY[1]) {
                $time = ($worldTime * 0.06) + 360;
                $time = round($time);
                return Time::format(gmdate("i:s", $time), $time);
            }
        }

        $worldTime = floatval($world->getTime());
        $currentDay = self::getCurrentDay($world);
        $time = ($worldTime - self::rangeOfDay($currentDay)[0]) * 0.06;
        $time = round($time);
        return Time::format(gmdate("i:s", $time), $time);
    }

}