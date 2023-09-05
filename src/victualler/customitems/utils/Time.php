<?php

namespace victualler\customitems\utils;

class Time {

    public static function getTimeToString($time) : String {
        return gmdate("i:s", $time);
    }

    public static function getTimeToFullString($time) : String {
        return gmdate("H:i:s", $time);
    }
}

?>