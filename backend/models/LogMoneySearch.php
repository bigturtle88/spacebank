<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\LogMoney;

/**
 * LogMoneySearch represents the model behind the search form about `common\models\LogMoney`.
 */
class LogMoneySearch extends LogMoney
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','sum'], 'integer'],
            [['created_at','updated_at','tip','status'],'safe']
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
        $query = LogMoney::find();

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
        if (!empty($params['LogMoneySearch']['user_id'])) {
            $username=$params['LogMoneySearch']['user_id'];
            $userid=(new \yii\db\Query())  
            ->select(['id'])
            ->from('user')
            ->where(['username' => $username])
            ->scalar();
            $this->user_id=$userid;
        }
        
        
        if (!empty($params['LogMoneySearch']['created_at']) && !empty($params['LogMoneySearch']['updated_at'])) {
            $c1=split('-',$params['LogMoneySearch']['created_at']);
            $c2=split('-',$params['LogMoneySearch']['updated_at']);
            $start=mktime(0, 0, 0, $c1[1], $c1[2], $c1[0]);
            $finish=mktime(0, 0, 0, $c2[1], $c2[2], $c2[0]);
            $query->andWhere(['between', 'created_at', $start, $finish]);
        }
        
        $query->andFilterWhere([
            'id' => $this->id,
            'sum' => $this->sum,
            'user_id' => $this->user_id,
            'tip' => $this->tip,
            'status' => $this->status,
        ]);
            
        if(!empty($username))$this->user_id=$username;
        if(!empty($params['LogMoneySearch']['created_at']))$this->created_at=$params['LogMoneySearch']['created_at'];
        if(!empty($params['LogMoneySearch']['updated_at']))$this->updated_at=$params['LogMoneySearch']['updated_at'];

        return $dataProvider;
    }
}
