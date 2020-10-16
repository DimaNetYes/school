<?php


namespace app\models;


use yii\db\ActiveRecord;

class Appeal extends ActiveRecord
{
    public $name, $birthday, $kindergarden;
    public function rules()
    {
        return [
            [['name', 'birthday', 'kindergarden'], 'required'],
            ['name', 'string']
        ];
    }

}