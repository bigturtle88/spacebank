<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Order extends ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%orders}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [[
            'user_id',
            'apartment_type_id',
            'season_id',
            'interval',
            'interval_numbers',
            'apartment_number',
            'bonus_weeks',
            'club_id',
            'source_id',
            'country_id',
            'price_show',
            'priced_value',
            'priced_currency',
            'type',
            'is_active',
            'created_at',
            'updated_at',
                ], 'required'],
            [['priced_value'],'integer'],
        ];
    }

    const TYPE_SELL = 1;
    const TYPE_BUY = 2;
    const TYPE_CLOSE = 3;

    public static function getStatuses() {
        return [
            self::TYPE_SELL => 'Sell',
            self::TYPE_BUY => 'Buy',
            self::TYPE_CLOSE => 'Close',
       
        ];
    }

    public static function getOrderObjectList($type = null) {

        $params = array();
        $params['orders.user_id'] = Yii::$app->user->identity->id;

        if (!is_null($type)) {
            $params['type'] = $type;
        }

        return Order::find()
                        ->where($params)
                        ->all();
    }

    public static function getSearchOrderObjectList() {

        $params = array();
        $params['orders.user_id'] = Yii::$app->user->identity->id;

        if (!is_null($type)) {
            $params['type'] = $type;
        }

        return Order::find()
                        ->filterWhere($params)
                        ->all();
    }

    public function getCertificate() {

        $certificateName = $this->hasOne(Certificate::className(), ['id' => 'source_id'])->one();

        $certificateName = is_null($certificateName) ? new Certificate() : $certificateName;

        return $certificateName;
    }

    public function getOrderRequest() {
        $certificateName = $this->hasOne(OrderRequest::className(), ['id' => 'source_id'])->one();



        return $certificateName;
    }

    public function getClub() {

        $club = $this->hasOne(Club::className(), ['id' => 'club_id'])->one();
        $club = is_null($club) ? new Club() : $club;
        return $club;
    }

    public function getCountry() {

        $country = $this->hasOne(Country::className(), ['id' => 'country_id'])->one();

        $country = is_null($country) ? new Country() : $country;

        return $country;
    }

    public function getCountryString($countryString) {

        $arr = explode(',', trim(trim($countryString), ","));
        $list = ' ';
        $arr = array_unique($arr);

        foreach ($arr as $a) {

            $country = \common\models\Country::findOne($a);
            $list .= $country['name'] . '; ';
        }

        return $list;
    }

    public function getApartmentType() {
        $apartmentType = $this->hasOne(ApartmentType::className(), ['id' => 'apartment_type_id'])->one();
        $apartmentType = is_null($apartmentType) ? new ApartmentType() : $apartmentType;
        return $apartmentType;
    }

    public function getApartmentTypeString($apartmentTypeString) {

        $arr = explode(',', trim(trim($apartmentTypeString), ","));
        $list = ' ';
        $arr = array_unique($arr);

        foreach ($arr as $a) {

            $apartmentType = \common\models\ApartmentType::findOne($a);
            $list .= $apartmentType['name'] . '; ';
        }

        return $list;
    }

    public function getSeason() {
        $season = $this->hasOne(Season::className(), ['id' => 'season_id'])->one();
        $season = is_null($season) ? new ApartmentType() : $season;
        return $season;
    }

    public function getSeasonString($seasonString) {
        $arr = explode(',', trim(trim($seasonString), ","));
        $list = ' ';
        $arr = array_unique($arr);

        foreach ($arr as $a) {

            $season = \common\models\Season::findOne($a);
            $list .= $season['name'] . '; ';
        }

        return $list;
    }

    public function getQuantityCertificate() {

        $quantityCertificate = $this->hasOne(Packages::className(), ['id' => 'source_id'])->one();
        $quantity = is_null($quantityCertificate) ? new Packages() : $quantityCertificate;

        return $quantity;
    }

}
