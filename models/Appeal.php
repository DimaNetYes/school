<?php


namespace app\models;


use yii\db\ActiveRecord;

class Appeal extends ActiveRecord
{
//    public $childName, $birthday;
    public $appeal_id;

    public function rules()
    {
        return [
            [['childName', 'birthday'], 'required'],
            ['childName', 'string']
        ];
    }

    public function attributeLabels()
    {
        return [
            'appeal_id' => '',
        ];
    }

    public function getPka()
    {
        return $this->hasMany(Pka::className(), ['appeal_id' => 'id']);
    }

}