<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\LogDeals;

/**
 * LogOfferSearch represents the model behind the search form about `common\models\LogDeals`.
 */
class LogDealsSearch extends LogDeals
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','priced_value','packages_id'], 'integer'],
            [['created_at','updated_at','seller_id','buyer_id','priced_currency'],'safe']
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
        $query = LogDeals::find();

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
        if (!empty($params['LogDealsSearch']['seller_id'])) {
            $this->seller_id=(new \yii\db\Query())  
            ->select(['id'])
            ->from('user')
            ->where(['username' => $params['LogDealsSearch']['seller_id']])
            ->scalar();
        }
        if (!empty($params['LogDealsSearch']['buyer_id'])) {
            $this->buyer_id=(new \yii\db\Query())  
            ->select(['id'])
            ->from('user')
            ->where(['username' => $params['LogDealsSearch']['buyer_id']])
            ->scalar();
        }
        
        
        if (!empty($params['LogDealsSearch']['created_at']) && !empty($params['LogDealsSearch']['updated_at'])) {
            $c1=split('-',$params['LogDealsSearch']['created_at']);
            $c2=split('-',$params['LogDealsSearch']['updated_at']);
            $start=mktime(0, 0, 0, $c1[1], $c1[2], $c1[0]);
            $finish=mktime(0, 0, 0, $c2[1], $c2[2], $c2[0]);
            $query->andWhere(['between', 'created_at', $start, $finish]);
        }
        
        $query->andFilterWhere([
            'id' => $this->id,
            'seller_id' => $this->seller_id,
            'buyer_id' => $this->buyer_id,
            'priced_value' => $this->priced_value,
            'priced_currency' => $this->priced_currency,
            'packages_id' => $this->packages_id,
        ]);

        if(!empty($params['LogDealsSearch']['seller_id']))$this->seller_id=$params['LogDealsSearch']['seller_id'];
        if(!empty($params['LogDealsSearch']['buyer_id']))$this->buyer_id=$params['LogDealsSearch']['buyer_id'];
        if(!empty($params['LogDealsSearch']['created_at']))$this->created_at=$params['LogDealsSearch']['created_at'];
        if(!empty($params['LogDealsSearch']['updated_at']))$this->updated_at=$params['LogDealsSearch']['updated_at'];

        return $dataProvider;
    }
}
