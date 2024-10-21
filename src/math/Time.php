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


namespace pixelwhiz\times\math;


class Time {


    /**
     * Format time to AM or PM
     * @param string $gmdate
     * @param float $time
     * @return string
     */
    public static function format(string $gmdate, float $time): string {
        if ($time >= 0 && $time < 720) {
            return "{$gmdate} AM";
        } elseif ($time >= 720 && $time < 1440) {
            return "{$gmdate} PM";
        } else {
            return "00:00 AM";
        }
    }


}