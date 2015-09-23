<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

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
    public $user_avatar;
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
            [['email'], 'email','message'=>'Email invalid'],
            [['login'], 'unique','message'=>'Login already exists!'],
            [['email'], 'unique','message'=>'Email already exists!'],
            [['user_avatar'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 1],
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
    public function upload()
    {
        var_dump($this->user_avatar);
        die();
        if ($this->validate()) {
            foreach ($this->user_avatar as $file) {
                $file->saveAs('/media/users_photo' . $file->baseName . '.' . $file->extension);
            }
            return true;
        } else {
            return false;
        }
    }
}
