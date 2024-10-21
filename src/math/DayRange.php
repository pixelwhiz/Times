<?php

namespace pixelwhiz\times\math;

class DayRange {

    public const DAYS = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];

    public const SUNDAY = [0, 18000, 162000, 168000];
    public const MONDAY = [18000, 42000];
    public const TUESDAY = [42000, 66000];
    public const WEDNESDAY = [66000, 90000];
    public const THURSDAY = [90000, 114000];
    public const FRIDAY = [114000, 138000];
    public const SATURDAY = [138000, 162000];
    
}
