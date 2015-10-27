<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "works".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $date
 * @property string $src_image
 * @property integer $price
 * @property string $work_description
 */
class Works extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'works';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'price'], 'integer'],
            [['date'], 'safe'],
            [['src_image'], 'string'],
            [['work_description','work_name'], 'string', 'max' => 255]
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
            'date' => 'Date',
            'src_image' => 'Src Image',
            'price' => 'Цена',
            'work_description' => 'Описание',
            'work_name' => 'Название работы',
        ];
    }
}
