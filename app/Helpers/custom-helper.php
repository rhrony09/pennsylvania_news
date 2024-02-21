<?php

use Illuminate\Support\Str;

function make_slug($string) {
    return preg_replace('/\s+/u', '-', str_replace([',', ':', ';', '&', '@', '#', '$', '!', '‘', '’'], '', trim($string)));
}

function limitString($string, $limit = 180) {
    return Str::limit($string, $limit, '...');
}

function convertTimeToBangla($time) {
    $bangla_numbers = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
    $bangla_am_pm = ['এএম', 'পিএম'];
    $bangla_time = str_replace(range(0, 9), $bangla_numbers, $time);
    $bangla_time = str_replace(array('AM', 'PM'), $bangla_am_pm, $bangla_time);

    return $bangla_time;
}
