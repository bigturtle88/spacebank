<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Country;

/**
 * ClubsSearch represents the model behind the search form about `app\models\Clubs`.
 */
class CountrySearch extends Country
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_active'], 'integer'],
            [['name', 'iso_3166'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Country::find();

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
        ]);
        
        if($this->is_active==1)$query->andFilterWhere([
            'is_active' => $this->is_active
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'iso_3166', $this->iso_3166]);

        return $dataProvider;
    }
}
