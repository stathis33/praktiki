<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Externalabusers;

/**
 * ExternalabusersSearch represents the model behind the search form of `app\models\Externalabusers`.
 */
class ExternalabusersSearch extends Externalabusers
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'permission', 'status'], 'integer'],
            [['IP', 'mask', 'date_added', 'date_modified', 'listed_by','TTL'], 'safe'],
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
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $query = Externalabusers::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'permission' => $this->permission,
            'status' => $this->status,
            'date_modified' => $this->date_modified,
            'TTL' => $this->TTL,
        ]);

        $query->andFilterWhere(['like', 'IP', $this->IP])
            ->andFilterWhere(['like', 'mask', $this->mask])
            ->andFilterWhere(['like', 'date_added', $this->date_added])
            ->andFilterWhere(['like', 'listed_by', $this->listed_by]);

        return $dataProvider;
    }
}
