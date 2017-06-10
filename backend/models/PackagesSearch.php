<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Packages;

/**
 * PackagesSearch represents the model behind the search form about `common\models\Packages`.
 */
class PackagesSearch extends Packages
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'club_id', 'country_id', 'quantity', 'priced_sum', 'is_active', 'is_blocked', 'virtual'], 'integer'],
            [['company', 'user_id', 'apartment_type_id', 'certificate_period', 'season_id', 'priced_currency', 'status', 'created_at', 'updated_at'], 'safe'],
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
        $query = Packages::find();

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
        if (!empty($params['PackagesSearch']['user_id'])) {
            $username=$params['PackagesSearch']['user_id'];
            $userid=(new \yii\db\Query())  
            ->select(['id'])
            ->from('user')
            ->where(['username' => $username])
            ->scalar();
            if(is_integer($userid))$this->user_id=$userid;else$this->user_id=0;
        }
        
        
        if (!empty($params['PackagesSearch']['created_at']) && !empty($params['PackagesSearch']['updated_at'])) {
            $c1=split('-',$params['PackagesSearch']['created_at']);
            $c2=split('-',$params['PackagesSearch']['updated_at']);
            $start=mktime(0, 0, 0, $c1[1], $c1[2], $c1[0]);
            $finish=mktime(0, 0, 0, $c2[1], $c2[2], $c2[0]);
            $query->andWhere(['between', 'created_at', $start, $finish]);
        }
        
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'club_id' => $this->club_id,
            'quantity' => $this->quantity,
            'priced_sum' => $this->priced_sum,
            'priced_currency' => $this->priced_currency,
            'status' => $this->status,
        ]);
        
        if($this->is_active==1)$query->andFilterWhere([
            'is_active' => $this->is_active
        ]);

        if($this->is_blocked==1)$query->andFilterWhere([
            'is_blocked' => $this->is_blocked
        ]);
        
        if($this->country_id)$query->andFilterWhere(['like', 'country_id', ','.$this->country_id.',']);
        if($this->company)$query->andFilterWhere(['like', 'company', ','.$this->company.',']);
        if($this->apartment_type_id)$query->andFilterWhere(['like', 'apartment_type_id', ','.$this->apartment_type_id.',']);
        if($this->certificate_period)$query->andFilterWhere(['like', 'certificate_period', ','.$this->certificate_period.',']);
        if($this->season_id)$query->andFilterWhere(['like', 'season_id', ','.$this->season_id.',']);
        
        //echo'<pre>';var_dump($query);exit;

        if(!empty($username))$this->user_id=$username;
        if(!empty($params['PackagesSearch']['created_at']))$this->created_at=$params['PackagesSearch']['created_at'];
        if(!empty($params['PackagesSearch']['updated_at']))$this->updated_at=$params['PackagesSearch']['updated_at'];

        
        return $dataProvider;
    }
}
