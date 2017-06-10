<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Certificate;

/**
 * PackagesSearch represents the model behind the search form about `common\models\Packages`.
 */
class CertificateSearch extends Certificate
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [			
            [['id', 'certificate_period', 'club_id', 'company_id', 'country_id', 'priced_sum', 'is_approved', 'is_archive', 'apartment_type_id', 'season_id'], 'integer'],
            [['certificate_code', 'user_id'], 'safe'],
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
        $query = Certificate::find();

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
        if (!empty($params['CertificateSearch']['user_id'])) {
            $username=$params['CertificateSearch']['user_id'];
            $userid=(new \yii\db\Query())  
            ->select(['id'])
            ->from('user')
            ->where(['username' => $username])
            ->scalar();
            if(is_integer($userid))$this->user_id=$userid;else$this->user_id=0;
        }
        
        
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'country_id' => $this->country_id,
            'company_id' => $this->company_id,
            'apartment_type_id' => $this->apartment_type_id,
            'club_id' => $this->club_id,
            'certificate_period' => $this->certificate_period,
            'season_id' => $this->season_id,
            'priced_sum' => $this->priced_sum,
            'priced_currency' => $this->priced_currency,
            'is_approved' => $this->is_approved,
            'is_archive' => $this->is_archive,
        ]);
        

        if(!empty($username))$this->user_id=$username;

        
        return $dataProvider;
    }
}
