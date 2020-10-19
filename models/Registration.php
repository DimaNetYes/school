<?php


namespace app\models;


use yii\base\Model;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use Yii;

class Registration extends ActiveRecord implements IdentityInterface
{
//    public $login;
//    public $password;
//    public $name;
//    public $role;

    public function rules()
    {
        return [
            [['login', 'password', 'name', 'role'], 'required'],
            ['login', 'unique', 'targetClass' => Registration::className(),  'message' => 'Этот логин уже занят'],
            ['name', 'string']
        ];
    }

    public static function findIdentity($id)
    {
        // TODO: Implement findIdentity() method.
        return static::findOne($id);
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    public function getId()
    {
        // TODO: Implement getId() method.
    }

    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }

    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }
}