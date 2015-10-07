<?php
namespace yii\helpers;
use Yii;
class BasicHelper{

    public static function getDateDiff ($date_from, $date_till) {
        $date_from = explode('-', $date_from);
        $date_till = explode('-', $date_till);

        $time_from = mktime(0, 0, 0, $date_from[1], $date_from[2], $date_from[0]);
        $time_till = mktime(0, 0, 0, $date_till[1], $date_till[2], $date_till[0]);

        $diff = floor( ($time_from - $time_till)/60/60/24/365 );


        return $diff;
    }

//    public static function getYearsWord($years){
//        switch(true){
//            case substr($years,-1) > 4 && $years > 4 : $word = 'лет'; break;
//            case fmod($years, 10) == 1 : $word = 'год'; break;
//            default: $word = 'года';
//        }
//        return substr($years,-1);
//    }

}
