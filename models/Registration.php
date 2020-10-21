<?php


namespace app\models;


use yii\base\Model;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use Yii;

class Registration extends ActiveRecord implements IdentityInterface
{
    public $rememberMe = true;
    private $_user = false;

    public function rules()
    {
        return [
            [['login', 'password', 'name', 'role'], 'required'],
            ['login', 'unique', 'targetClass' => Registration::className(),  'message' => 'Этот логин уже занят'],
            ['name', 'string']
        ];
    }
        //получает пользователя по id
    public static function findIdentity($id)
    {
        // TODO: Implement findIdentity() method.
        return static::findOne($id);
    }
        //
    public static function findByUsername($login)
    {
        return static::findOne(['login' => $login]);
    }

    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }

    public function login($login)
    {
        return Yii::$app->user->login($login, $this->rememberMe ? 3600*24*30 : 0);
    }

    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = Registration::findByUsername($this->login);
        }

        return $this->_user;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    public function getId()
    {
        // TODO: Implement getId() method.
        return $this->id;
    }

    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
        return $this->getAuthKey() === $authKey;
    }

    public function getPka()
    {
        return $this->hasMany(Pka::className(), ['parent_id' => 'id']);
    }
}