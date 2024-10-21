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

class DayRange {

    public const DAYS = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    public const TIMES = ["Sunrise", "Day", "Noon", "Sunset", "Night", "Midnight"];
    public const INCREMENT_TIME = [
        "Sunrise" => 5000,
        "Day" => 7000,
        "Noon" => 12000,
        "Sunset" => 18000,
        "Night" => 19000,
        "Midnight" => 23000,
    ];

    public const SUNDAY_INCREMENT_TIME = [
        "Sunrise" => 5000,
        "Day" => 1000,
        "Noon" => 6000,
        "Sunset" => 12000,
        "Night" => 13000,
        "Midnight" => 17000,
    ];


    public const SUNDAY = [0, 18000, 162000, 168000];
    public const MONDAY = [18000, 42000];
    public const TUESDAY = [42000, 66000];
    public const WEDNESDAY = [66000, 90000];
    public const THURSDAY = [90000, 114000];
    public const FRIDAY = [114000, 138000];
    public const SATURDAY = [138000, 162000];

}
