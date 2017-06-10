<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Order;
use common\models\Certificate;
use common\models\Offer;

class OfferTradeForm extends Model {

    public $id;
    public $club_id;
    public $country;
    public $source_id;
    public $start_date;
    public $end_date;
    public $contract_code;
    public $contract_date;
    public $certificate_period;
    public $certificate_sum;
    public $certificate_currency;
    public $apartment_type_id;
    public $season_id;
    public $interval;
    public $interval_numbers;
    public $apartment_number;
    public $bonus_weeks;
    public $points;
    public $fees_start_sum;
    public $fees_start_currency;
    public $fees_current_sum;
    public $fees_current_currency;
    public $is_penalty;
    public $penalty_start_sum;
    public $penalty_start_currency;
    public $fees_loan_sum;
    public $fees_loan_currency;
    public $certificate_loan_sum;
    public $certificate_loan_currency;
    public $status;
    public $is_expertize;
    public $is_membership;
    public $is_priced;
    public $priced_sum;
    public $priced_currency;
    public $is_approved;
    public $is_archive;
    public $created_at;
    public $updated_at;
    public $certificate_file;
    public $priced_value;
    public $price_show;
    public $certificate_code;
    public $seller_id;
    public $buyer_id;
    public $bid;
    public $expertise;
    public $order_id;
    public $description;
    public $offer_id;
    public $author_id;
    public $user_id;
public $type;
    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['bid'],
                'required'],
                [['bid'],
                'integer'], ['description', 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'club_id' => Yii::t('frontend', 'Club'), // select список клубов
            'source_id' => Yii::t('frontend', 'Code of certificate'), // код сертификата
            'start_date' => Yii::t('frontend', 'Date of start'), // начало действия сертификата
            'end_date' => Yii::t('frontend', 'Date of end'), // 
            'contract_date' => Yii::t('frontend', 'Date of contract'),
            'certificate_period' => Yii::t('frontend', 'Certificate period'),
            'certificate_sum' => Yii::t('frontend', 'Certificate costs'),
            'certificate_currency' => Yii::t('frontend', 'Currency'),
            'apartment_type_id' => Yii::t('frontend', 'Apartment type'), // select типы апартаментов
            'season_id' => Yii::t('frontend', 'Season'), // select выбор сезона
            'interval' => Yii::t('frontend', 'Interval'),
            'interval_numbers' => Yii::t('frontend', 'Number of intervals'),
            'apartment_number' => Yii::t('frontend', 'Number of appartments'),
            'bonus_weeks' => Yii::t('frontend', 'Bonus weeks'),
            'points' => Yii::t('frontend', 'Points'),
            'fees_start_sum' => Yii::t('frontend', 'Start sum of fees'),
            'fees_start_currency' => Yii::t('frontend', 'Currency'),
            'fees_current_sum' => Yii::t('frontend', 'Current fees sum'),
            'fees_current_currency' => Yii::t('frontend', 'Currency'),
            'is_penalty' => Yii::t('frontend', 'Penalty'), // checkbox bool
            'penalty_start_sum' => Yii::t('frontend', 'Start sum of penalty'),
            'penalty_start_currency' => Yii::t('frontend', 'Currency'),
            'fees_loan_sum' => Yii::t('frontend', 'Sum of fees loan'),
            'fees_loan_currency' => Yii::t('frontend', 'Currency'),
            'certificate_loan_sum' => Yii::t('frontend', 'Sum of certificate loan'),
            'certificate_loan_currency' => Yii::t('frontend', 'Currency'),
            'status' => Yii::t('frontend', 'Status'), // select список статусов
            'is_expertize' => Yii::t('frontend', 'Expertize'), // bool
            'is_membership' => Yii::t('frontend', 'Membership'), // bool
            'is_priced' => Yii::t('frontend', 'Priced'), // bool
            'priced_sum' => Yii::t('frontend', 'Priced sum'),
            'priced_currency' => Yii::t('frontend', 'Currency'),
            'priced_value' => Yii::t('frontend', 'Price'),
            'price_show' => Yii::t('frontend', 'Price show'),
            'bid' => Yii::t('frontend', 'Bid'),
            'description' => Yii::t('frontend', 'Description'),
        ];
    }

    /**
     * Save certificate.
     *
     * @return true|null the saved model or null if saving fails
     */
    public function save() {
        $modelOffer = new Offer();
        $modelOffer->setAttributes($this->attributes);
        $modelOffer->created_at = time();
        $modelOffer->updated_at = time();
        return $modelOffer->save();
    }

    /**
     * @inheritdoc
     */
    public function getOffer() {

        $offer = Offer::findOne($this->offer_id);
        return $offer;
    }

}
