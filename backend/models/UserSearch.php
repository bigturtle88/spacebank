<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\User;

/**
 * UserSearch represents the model behind the search form about `common\models\User`.
 */
class UserSearch extends User {

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'tel', 'is_individual'], 'integer'],
            [['username', 'user_type', 'email', 'fio', 'contact', 'firm_name'], 'safe'],
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
        $query = User::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate())
        {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'tel' => $this->tel,
        ]);

        if($this->is_individual){
            $query->andFilterWhere([
            'is_individual' => $this->is_individual,
        ]);
        }
        if($this->user_type!=''){
            if($this->user_type=='User')$query->andWhere("user_type=''");
            else $query->andFilterWhere(['user_type' => $this->user_type]);
        }
        $query->andFilterWhere(['like', 'username', $this->username])
                ->andFilterWhere(['like', 'email', $this->email])
                ->andFilterWhere(['like', 'fio', $this->fio])
                ->andFilterWhere(['like', 'contact', $this->contact])
                ->andFilterWhere(['like', 'firm_name', $this->firm_name]);

        return $dataProvider;
    }

}
