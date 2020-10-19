<?php


namespace app\models;


use yii\db\ActiveRecord;

class Appeal extends ActiveRecord
{
    public $name, $birthday;
    public function rules()
    {
        return [
            [['name', 'birthday'], 'required'],
            ['name', 'string']
        ];
    }

}