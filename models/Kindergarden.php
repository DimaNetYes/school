<?php


namespace app\models;


use yii\db\ActiveRecord;

class Kindergarden extends ActiveRecord
{

    public function rules()
    {
        return [
            [['name', 'capacity'], 'required'],
            ['name', 'safe'],
            ['capacity', 'safe'],
            ['appeal', 'safe']

        ];
    }

    public function getPka()
    {
        return $this->hasMany(Pka::className(), ['kindergarden_id' => 'id']);
    }
}