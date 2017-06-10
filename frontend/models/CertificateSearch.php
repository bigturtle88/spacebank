<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Certificate;
use yii\db\Query;
use \common\models\Broker;
use common\models\User;

/**
 * CertificateSearch represents the model behind the search form about `common\models\Certificate`.
 */
class CertificateSearch extends Certificate {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['club_id', 'user_id'], 'string'],
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



        // add conditions that should always apply here
        $query = Certificate::find();


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        //  var_dump( $this->load($params) );die();
        // grid filtering conditions

        if (Yii::$app->user->identity->user_type == User::TYPE_BROKER) {

            $query->andFilterWhere(['certificates.user_id' => $this->user_id,
                        'club_id' => $this->club_id,
                    ])->andWhere(['package_id' => null])
                    ->andWhere(['broker_id' => Yii::$app->user->identity->id]);
        } else {
            $query->filterWhere([
                'club_id' => $this->club_id,
                'certificates.user_id' => Yii::$app->user->identity->id,
            ])->andWhere(['package_id' => null]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC],
            ], 'pagination' => [
                'pageSize' => 100,
            ],
        ]);

        return $dataProvider;
    }

}
