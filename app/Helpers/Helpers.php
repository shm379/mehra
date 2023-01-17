<?php // Code within app\Helpers\Helpers.php

namespace App\Helpers;

use App\Models\Product;
use Config;
use Illuminate\Support\Str;

class Helpers
{
    /**
     * @param $number
     * @return string
     */
    static function mobileNumberNormalize($number,$withCountry=true,$withZero=false)
    {
        preg_match("/^(\+98|0)?(?<number>[0-9]+)$/", $number, $match);
        if (isset($match['number']) && $match['number'] != '') {
            if($withCountry){
                return '+98'.$match['number'];
            }
            if($withZero) {
                return '0' . $match['number'];
            }
            return $match['number'];
        }

        return '';
    }

    static function toman($price,$separator=',')
    {
        return number_format($price,0, '',$separator) . ' تومان';
    }

    static function toEnglishNumber(String $string): String {
        $persinaDigits1 = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $persinaDigits2 = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١', '٠'];
        $allPersianDigits = array_merge($persinaDigits1, $persinaDigits2);
        $replaces = [...range(0, 9), ...range(0, 9)];

        return str_replace($allPersianDigits, $replaces , $string);
    }

    static function isArabicOrPersianNumber(String $string): String {
        $persian_numbers = '\x{06F0}-\x{06F9}';
        $arabic_numbers = '\x{0660}-\x{0669}';
        return (bool)preg_match("/(^[" .
            $arabic_numbers .
            $persian_numbers .
            "]+$)/u", $string);
    }

    static function isProduct($model): bool
    {
        return is_a($model,Product::class) || is_subclass_of($model,Product::class);
    }

    static function asSelectLabelValueArray($array){
        return array_map(function($v,$k){
            return ['label'=>$v,'value'=>$k];
        },$array,array_keys($array));
    }
    static function asSelectTitleIdArray($array){
        return array_map(function($v,$k){
            return ['title'=>$v,'id'=>$k];
        },$array,array_keys($array));
    }
    static function convertResourceToArray($resource){
        return json_decode($resource->toJson(),true);
    }

    static function removeBracketFromString($string) {
        return preg_replace("/\[|\]/", "", $string);
    }
}
