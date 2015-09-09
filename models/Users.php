<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $login
 * @property string $pass_hash
 * @property string $name
 * @property string $surname
 * @property string $email
 * @property integer $city_id
 * @property string $date_born
 * @property string $date_reg
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['city_id'], 'integer'],
            [['date_born', 'date_reg'], 'safe'],
            [['login', 'pass_hash', 'name', 'surname', 'email'], 'string', 'max' => 255],
            [['login', 'pass_hash', 'email'], 'required'],
            [['email'], 'email'],
//            [['pass_hash'], 'min' => 6],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Login',
            'pass_hash' => 'Pass Hash',
            'name' => 'Name',
            'surname' => 'Surname',
            'email' => 'Email',
            'city_id' => 'City ID',
            'date_born' => 'Date Born',
            'date_reg' => 'Date Reg',
        ];
    }
}
