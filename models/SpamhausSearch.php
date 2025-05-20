<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class SpamhausSearch extends Spamhaus
{
    public function rules()
    {
        return [
            [['id', 'permission', 'protocol', 'status'], 'integer'],
            [['source', 'destination', 'date_added', 'date_modified'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Bogon::find()->with(['permission0', 'protocol0', 'rangeParameter0']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 10],
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'permission' => $this->permission,
            'protocol' => $this->protocol,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'source', $this->source])
              ->andFilterWhere(['like', 'destination', $this->destination])
              ->andFilterWhere(['like', 'date_added', $this->date_added])
              ->andFilterWhere(['like', 'date_modified', $this->date_modified]);

        return $dataProvider;
    }
}
