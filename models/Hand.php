<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hand".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $trade_id
 * @property integer $price
 * @property string $date
 */
class Hand extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hand';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'trade_id', 'price'], 'integer'],
            [['date'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'trade_id' => 'Trade ID',
            'price' => 'Price',
            'date' => 'Date',
        ];
    }
}
