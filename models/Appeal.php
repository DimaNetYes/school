<?php


namespace app\models;


use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;

class Appeal extends ActiveRecord
{
    public $statusCode = [1 => 'На рассмотрении', 2 => 'Принята', 3 => 'Отклонена', 4 => 'Нет мест'];
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
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = AppealGrid::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 5],
            'sort' => [
                'attributes' => [
//                    'created_at' => SORT_DESC,
                    'id' => SORT_ASC,
                ]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'number' => $this->number,
            'date' => $this->date,
            'birthday' => $this->birthday,
        ]);

        $query->andFilterWhere(['like', 'childName', $this->childName])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'rejectionReason', $this->rejectionReason]);

        return $dataProvider;
    }

    public function getPka()
    {
        return $this->hasMany(Pka::className(), ['appeal_id' => 'id']);
    }

}