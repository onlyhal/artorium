<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

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
 * @property string $password_repeat
 */
class Users extends ActiveRecord implements IdentityInterface
{
    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;

    public $password_repeat;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    //social

    /*public static function findIdentity($id)
    {
        return static::findOne($id);
    }*/
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }
    public function getId()
    {
        return $this->id;
    }
    public function getAuthKey()
    {
        return $this->auth_key;
    }
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
    //end social

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['city_id'], 'integer'],
            [['date_born', 'date_reg'], 'safe'],
            [['pass_hash', 'user_avatar'], 'string', 'max' => 255],

            [['login'], 'string', 'max' => 15],
            [['name', 'surname', 'email'], 'string', 'max' => 30],

            [['login', 'pass_hash', 'email'], 'required'],
            ['password_repeat', 'required'],
            ['password_repeat', 'compare', 'compareAttribute'=>'pass_hash', 'message'=>"Passwords don't match" ],

            [['login'], 'filter', 'filter' => function($value) {
                return trim(htmlentities(strip_tags(str_replace(" ","",$value)), ENT_QUOTES, 'UTF-8'));
            }],


            [['email'], 'unique','message'=>'Email already exists!'],
            [['email'], 'email','message'=>'Email invalid'],
            [['login'], 'unique','message'=>'Login already exists!'],
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
        //var_dump($this->user_avatar);
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

    //соц сети
    public $profile;

    public static function findIdentity($id) {
        if (Yii::$app->getSession()->has('user-'.$id)) {
            return new self(Yii::$app->getSession()->get('user-'.$id));
        }
        else {
            return isset(self::$users[$id]) ? new self(self::$users[$id]) : null;
        }
    }

    public static function findByEAuth($service) {
        if (!$service->getIsAuthenticated()) {
            throw new ErrorException('EAuth user should be authenticated before creating identity.');
        }

        $id = $service->getServiceName().'-'.$service->getId();
        $attributes = array(
            'id' => $id,
            'username' => $service->getAttribute('name'),
            'authKey' => md5($id),
            'profile' => $service->getAttributes(),
        );
        $attributes['profile']['service'] = $service->getServiceName();
        Yii::$app->getSession()->set('user-'.$id, $attributes);
        return new self($attributes);
    }

}
