<?php

namespace pixelwhiz\times\math;

use function gmdate;

class Time {

    public static function format(string $gmdate, int $time): string {
        if ($time >= 0 && $time < 720) {
            return "{$gmdate} AM";
        } elseif ($time >= 720 && $time < 1440) {
            return "{$gmdate} PM";
        } else {
            throw new \InvalidArgumentException("Invalid time value: $time. Time must be between 0 and 1440.");
        }
    }


}