<?php

namespace pixelwhiz\times\math;

use function gmdate;

class Time {

    public static function calculateTime(int $time): string {
        return gmdate("i:s", $time);
    }

}