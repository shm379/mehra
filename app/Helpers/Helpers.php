<?php // Code within app\Helpers\Helpers.php

namespace App\Helpers;

use Config;
use Illuminate\Support\Str;

class Helpers
{
    /**
     * @param $number
     * @return string
     */
    static function mobileNumberNormalize($number,$withCountry=true)
    {
        preg_match("/^(\+98|0)?(?<number>[0-9]+)$/", $number, $match);
        if (isset($match['number']) && $match['number'] != '') {
            if($withCountry){
                return '+98'.$match['number'];
            }
            return $match['number'];
        }

        return '';
    }
}
