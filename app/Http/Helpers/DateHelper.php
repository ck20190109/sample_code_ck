<?php
namespace App\Http\Helpers;

class DateHelper
{
    public static function transDateToRoute($s) {
        $s = substr($s,0,10);
        $s = str_replace('-','/',$s);
        return $s;
    }

    public static function transDateFormat($d) {
        $d = date_create($d);
        return date_format($d,"F d, Y");
    }

    public static function transMonthFormat($d,$f) {
        $d=date_create(substr($d,0,10));
        return date_format($d,$f);
    }
}