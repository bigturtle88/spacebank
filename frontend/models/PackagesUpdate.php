<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Certificate;
use common\models\Packages;
use common\models\CurrenciesQuery;

class PackagesUpdate extends Model {

    public $certificates;
    public $priced_sum;
    public $priced_currency;
    public $certificate_code;
    public $package;

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

    public function save() {

        Certificate::updateAll(['package_id' => null], 'package_id = ' . $this->package);
        $country_id = ',';
        $apartment_type_id = ',';
        $company = ',';
        $certificate_period = ',';
        $season_id = ',';
        $priced_sum = 0;
        $quantity = 0;


        $model = Packages::find()->where(['id' => $this->package])->one();

        $model->user_id = Yii::$app->user->identity->id;
        $model->club_id;
        $model->company = $company;
        $model->country_id = $country_id;

        $model->updated_at = time();
        $certificateArray = $this->certificates;

        foreach ($certificateArray as $certificateOne) {

            $certificate = Certificate::find()->where(['certificate_code' => $certificateOne])->one();


            $certificate->package_id = $this->package;
            $certificate->save(false);
            $country_id .= $certificate->country_id . ',';
            $apartment_type_id .= $certificate->apartment_type_id . ',';
            $company .= $certificate->company_id . ',';
            $certificate_period .= $certificate->certificate_period . ',';
            $season_id .= $certificate->season_id . ',';
            $quantity++;
            $priced_sum = $priced_sum + CurrenciesQuery::currencyExchange($certificate->certificate_sum, $certificate->certificate_currency);
        }
        $model->country_id = $country_id;
        $model->apartment_type_id = $apartment_type_id;
        $model->company = $company;
        $model->certificate_period = $certificate_period;
        $model->season_id = $season_id;
        $model->quantity = $quantity;
        $model->priced_sum = $priced_sum;

        return $model->update();
    }

}
