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

}