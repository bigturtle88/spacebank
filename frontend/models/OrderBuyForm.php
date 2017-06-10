<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Order;
use common\models\User;

class OrderBuyForm extends Model {

    public $user_id;
    public $club_id;
    public $country_id;
    public $apartment_type_id;
    public $season_id;
    public $interval;
    public $interval_numbers;
    public $apartment_number;
    public $bonus_weeks;
    public $price_show;
    public $priced_value;
    public $priced_currency;
    public $created_at;
    public $updated_at;
    public $source_id;
    public $quantity;
    public $clients;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
        [[
        'club_id',
        'country_id',
        'apartment_type_id',
        'season_id',
        'priced_value',
        'priced_currency',
        'quantity',
        ], 'required'],
       [['priced_value'], 'integer'],
        ['user_id', 'default', 'value' => Yii::$app->user->identity->id],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'quantity' => Yii::t('frontend', 'Quantity of certificate'),
            'club_id' => Yii::t('frontend', 'Club'),
            'country_id' => Yii::t('frontend', 'Country'),
            'apartment_type_id' => Yii::t('frontend', 'Apartment type'),
            'season_id' => Yii::t('frontend', 'Season'),
            'interval' => Yii::t('frontend', 'Interval'),
            'interval_numbers' => Yii::t('frontend', 'Number of intervals'),
            'apartment_number' => Yii::t('frontend', 'Number of appartments'),
            'bonus_weeks' => Yii::t('frontend', 'Bonus weeks'),
            'price_show' => Yii::t('frontend', 'Price show'),
            'priced_currency' => Yii::t('frontend', 'Currency'),
            'priced_value' => Yii::t('frontend', 'Price'),
            'user_id' => Yii::t('frontend', 'Clients'),
        ];
    }

    /**
     * Save certificate.
     *
     * @return true|null the saved model or null if saving fails
     */
    public function save() {


        $modelOrderBuyForm = new Order();
        $modelOrderBuyForm->setAttributes($this->attributes);
        $modelOrderBuyForm->author_id = Yii::$app->user->identity->id;
        $modelOrderBuyForm->type = Order::TYPE_BUY;
        $modelOrderBuyForm->is_active = 0;
        $modelOrderBuyForm->source_id = $modelOrderBuyForm->id;
        $modelOrderBuyForm->created_at = time();
        $modelOrderBuyForm->updated_at = time();
        $modelOrderBuyForm->source_id = 0;
        $modelOrderBuyForm->interval = 0;
        $modelOrderBuyForm->interval_numbers = 0;
        $modelOrderBuyForm->apartment_number = 0;
        $modelOrderBuyForm->bonus_weeks = 0;
        $modelOrderBuyForm->price_show = 0;
        if ($modelOrderBuyForm->save(false)) {
            return true;
        } else {
            return false;
        }
    }

}
