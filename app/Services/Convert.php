<?php

namespace App\Services;
use Carbon\Carbon;
use Verta;

class Convert {
    public static function convertToEnNumbers ( $string ) {
        $persian = [
            '۰' ,
            '۱' ,
            '۲' ,
            '۳' ,
            '۴' ,
            '۵' ,
            '۶' ,
            '۷' ,
            '۸' ,
            '۹',
        ];
        $arabic = [
            '٠' ,
            '١' ,
            '٢' ,
            '٣' ,
            '٤' ,
            '٥' ,
            '٦' ,
            '٧' ,
            '٨' ,
            '٩',
        ];
        $num = range(0 , 9);
        $convertedPersianNums = str_replace($persian , $num , $string);
        $englishNumbersOnly = str_replace($arabic , $num , $convertedPersianNums);

        return $englishNumbersOnly;
    }

    public static function jalaliToTimestamp ( $jalali = null ) {
        if ( $jalali == null ) {
            return null;
        }
        else {
            // sample = 1404/01/01
            $exploded = explode('/' , $jalali);
            $year = $exploded[ 0 ];
            $month = $exploded[ 1 ];
            $day = $exploded[ 2 ];
            $verta = Verta::jalaliToGregorian($year , $month , $day);
            // carbon
            $carbon = Carbon::createFromDate($verta[ 0 ] , $verta[ 1 ] , $verta[ 2 ]);

            return $carbon->timestamp;
        }
    }
}
