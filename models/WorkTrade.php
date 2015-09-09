<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "work_trade".
 *
 * @property integer $id
 * @property integer $work_id
 * @property string $date_trade
 */
class WorkTrade extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'work_trade';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['work_id'], 'integer'],
            [['date_trade'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'work_id' => 'Work ID',
            'date_trade' => 'Date Trade',
        ];
    }
}
