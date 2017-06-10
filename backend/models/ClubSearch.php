<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Club;

/**
 * ClubsSearch represents the model behind the search form about `app\models\Clubs`.
 */
class ClubSearch extends Club
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_active'], 'integer'],
            [['name', 'country'], 'safe'],
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
        $query = Club::find();

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
        $query->andFilterWhere([
            'is_active_server' => 1,
        ]);
        
        if($this->is_active==1)$query->andFilterWhere([
            'is_active' => $this->is_active
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'country', $this->country]);

        return $dataProvider;
    }
}
