<?php
namespace App;

class WriteLog {
    private static $isDebug = true;
    public static function write($m)
    {
        if (WriteLog::$isDebug) {
            $f = fopen("C:\\wamp64\\www\\wwc\\public\\admin\\storage\\logs\\test.txt","a");
            fwrite($f,$m."\n");
            fclose($f);
        }
    }
}