<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Client;

/**
 * ClientSearch represents the model behind the search form of `app\models\Client`.
 */
class ClientSearch extends Client
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'age', 'created'], 'integer'],
            [['hash_id', 'name', 'city', 'membership_date'], 'safe'],
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
        $query = Client::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'age' => $this->age,
            'created' => $this->created,
        ]);

        $query->andFilterWhere(['like', 'hash_id', $this->hash_id])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'membership_date', $this->membership_date]);

        return $dataProvider;
    }
}
