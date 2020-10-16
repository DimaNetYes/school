<?php


namespace app\models;


class Pka
{
//    public $parent_id, $kindergarden_id, $appeal_id;

    public function rules()
    {
        return [
            [['parent_id', 'kindergarden_id', 'appeal_id'], 'required']
        ];
    }

}