<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Certificate;
use common\models\Packages;
use common\models\CurrenciesQuery;

class PackagesDelete extends Model {

    public $certificates;
    public $priced_sum;
    public $priced_currency;
    public $certificate_code;
    public $package;
    public $id;

    public function rules() {
        return [
                [['certificate_code'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('common', 'ID'),
            'user_id' => Yii::t('backend', 'User ID'),
            'club_id' => Yii::t('backend', 'Club'),
            'country_id' => Yii::t('backend', 'Country'),
            'company' => Yii::t('backend', 'Company'),
            'apartment_type_id' => Yii::t('backend', 'Apartment Type ID'),
            'certificate_period' => Yii::t('backend', 'Certificate Period'),
            'season_id' => Yii::t('backend', 'Season ID'),
            'quantity' => Yii::t('backend', 'Quantity'),
            'priced_sum' => Yii::t('backend', 'Priced Sum'),
            'priced_currency' => Yii::t('backend', 'Priced Currency'),
            'is_active' => Yii::t('backend', 'Is Active'),
            'is_blocked' => Yii::t('backend', 'Is Blocked'),
            'status' => Yii::t('backend', 'Status'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),
            'virtual' => Yii::t('backend', 'Virtual'),
            'package_id' => Yii::t('frontend', 'Packages №'),
        ];
    }

    public function delete() {
        $model = Packages::findOne($this->id);

//        if ($model->user_id != Yii::$app->user->identity->id) {
//            return false;
//        }

        $modelOrder = \common\models\Order::find()->where(['source_id' => $model->id])->one();

        if (!empty($modelOrder)) {
            $modelOrder->delete();
            $modelOffer = \common\models\Offer::find()->where(['source_id' => $modelOrder->id])->one();
        }
        if (!empty($modelOffer)) {
            \common\models\Offer::deleteAll(['source_id' => $modelOrder->id]);
        }

        $model->delete();


        Certificate::updateAll(['package_id' => null], 'package_id = ' . $model->id);
        return true;
    }

}
