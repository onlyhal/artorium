<?php
namespace yii\helpers;
use Yii;
use app\models\Users;
class BasicHelper{

    public function getDateDiff ($date_from, $date_till) {
        $date_from = explode('-', $date_from);
        $date_till = explode('-', $date_till);

        $time_from = mktime(0, 0, 0, $date_from[1], $date_from[2], $date_from[0]);
        $time_till = mktime(0, 0, 0, $date_till[1], $date_till[2], $date_till[0]);

        $diff = floor( ($time_from - $time_till)/60/60/24/365 );


        return $diff;
    }

    public function getYearsWord($years){
        $strArr = ['лет', 'год', 'года', 'года', 'года', 'лет', 'лет', 'лет', 'лет', 'лет'];
        return $strArr[substr($years, strlen($years)-1)];
    }

    public function getUserByLogin($login){
        return Users::find()
            ->where([
                'login' => $login,
            ])->one();
    }
}
