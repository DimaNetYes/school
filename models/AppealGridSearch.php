<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AppealGrid;

/**
 * AppealGridSearch represents the model behind the search form of `app\models\AppealGrid`.
 */
class AppealGridSearch extends AppealGrid
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'number'], 'integer'],
            [['date', 'childName', 'birthday', 'status', 'rejectionReason'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
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

}
