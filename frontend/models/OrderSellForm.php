<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Order;
use common\models\Certificate;
use common\models\Packages;

class OrderSellForm extends Model {

    public $order_id;
    public $club_id;
    public $country_id;
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
    public $author_id;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [[
            'price_show',
            'priced_value',
            'source_id',
            'priced_currency'
                ],
                'required'],
                ['priced_value', 'integer'],
                [['priced_value'], 'string', 'length' => [1, 5]],
                ['author_id', 'default', 'value' => Yii::$app->user->identity->id],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'club_id' => Yii::t('frontend', 'Club'), // select список клубов
            'source_id' => Yii::t('frontend', 'Code of packages'), // код сертификата
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
        ];
    }

    /**
     * Save certificate.
     *
     * @return true|null the saved model or null if saving fails
     */
    public function save() {

        $modelOrder = new Order();
        $modelOrder->setAttributes($this->attributes);
        $packages = Packages::find()->where(['id' => $modelOrder->source_id])->one();

        $modelOrder->user_id = $packages->user_id;
        $modelOrder->type = Order::TYPE_SELL;
        $modelOrder->is_active = 0;
        $modelOrder->author_id = Yii::$app->user->identity->id;
        $modelOrder->club_id = $packages->club_id;
        $modelOrder->country_id = $packages->country_id;
        $modelOrder->apartment_type_id = $packages->apartment_type_id;
        $modelOrder->season_id = $packages->season_id;
        $modelOrder->interval = 0;
        $modelOrder->interval_numbers = 0;
        $modelOrder->apartment_number = 0;
        $modelOrder->bonus_weeks = 0;

        $modelOrder->created_at = time();
        $modelOrder->updated_at = time();

        return $modelOrder->save();
    }

}
