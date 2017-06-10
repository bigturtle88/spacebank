<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Offer;

/**
 * OfferSearch represents the model behind the search form about `common\models\Offer`.
 */
class OfferSearch extends Offer {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['id', 'seller_id', 'buyer_id', 'status', 'source_id', 'bid', 'expertise', 'expert_price', 'created_at', 'updated_at'], 'integer'],
                [['description'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
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
    public function search($params) {
        $query = Offer::find();

        // add conditions that should always apply here



        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->filterWhere([
            'id' => $this->id,
            'seller_id' => $this->seller_id,
            'buyer_id' => $this->buyer_id,
            'status' => $this->status,
            'source_id' => $this->source_id,
            'bid' => $this->bid,
            'expertise' => $this->expertise,
            'expert_price' => $this->expert_price,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $dataProvider;
    }

}
