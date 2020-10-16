<?php


namespace app\models;


use yii\base\Model;
use yii\db\ActiveRecord;

class Registration extends ActiveRecord
{
//    public $id;
//    public $login = '1234';
//    public $password;
//    public $name;
//    public $role;

    public function rules()
    {
        return [
            [['login', 'password', 'name', 'role'], 'required'],
            ['login', 'string'],
            ['name', 'string']
        ];
    }

}