<?php


namespace app\models;


use yii\db\ActiveRecord;

class Pka extends ActiveRecord
{
//    public $parent_id, $kindergarden_id, $appeal_id;

    public function rules()
    {
        return [
            [['parent_id', 'kindergarden_id', 'appeal_id'], 'required'],
            ['parent_id', 'safe'],
            ['kindergarden_id', 'safe'],
            ['appeal_id', 'safe']

        ];
    }

    public function getAppeal()
    {
        return $this->hasOne(Appeal::className(), ['id' => 'appeal_id']);
    }

    public function getKindergarden()
    {
        return $this->hasOne(Kindergarden::className(), ['id' => 'kindergarden_id']);
    }

    public function getRegistration()
    {
        return $this->hasOne(Registration::className(), ['id' => 'parent_id']);
    }

}