<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "appeal".
 *
 * @property int $id
 * @property int $number
 * @property string $date
 * @property string $childName
 * @property string $birthday
 * @property string $status
 * @property string|null $rejectionReason
 *
 * @property Pka[] $pkas
 */
class AppealGrid extends \yii\db\ActiveRecord
{
    public $statusCode = [1 => 'На рассмотрении', 2 => 'Принята', 3 => 'Отклонена', 4 => 'Нет мест'];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appeal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['number', 'date', 'childName', 'status'], 'required'],
            [['number'], 'integer'],
            [['date', 'birthday'], 'safe'],
            [['childName', 'status', 'rejectionReason'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'number' => 'Number',
            'date' => 'Date',
            'childName' => 'Child Name',
            'birthday' => 'Birthday',
            'status' => 'Status',
            'rejectionReason' => 'Rejection Reason',
        ];
    }

    /**
     * Gets query for [[Pkas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPkas()
    {
        return $this->hasMany(Pka::className(), ['appeal_id' => 'id']);
    }
}
