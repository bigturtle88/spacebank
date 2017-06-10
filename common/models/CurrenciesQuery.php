<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the ActiveQuery class for [[Currencies]].
 *
 * @see Currencies
 */
class CurrenciesQuery extends \yii\db\ActiveQuery {
    /* public function active()
      {
      return $this->andWhere('[[status]]=1');
      } */

    /**
     * @inheritdoc
     * @return Currencies[]|array
     */
    public function all($db = null) {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Currencies|array|null
     */
    public function one($db = null) {
        return parent::one($db);
    }

    public static function getCurrenciesList() {
        $currencies = Currencies::find()
                ->select(['code', 'code'])
                ->all();

        return ArrayHelper::map($currencies, 'code', 'code');
    }

    /**
     *  The method shows the rate of the currency
     * @param $code char
     * @return integer|null
     */
    public function currencyTransfer($code) {

        $currency = Currencies::find()
                ->select('rate')
                ->where('code = :code', [':code' => $code])
                ->one();

        if($currency)$currencyValue = (!$currency->rate) ? null : Yii::$app->user->identity->money * $currency->rate;
        else $currencyValue='';
        
        return $currencyValue;
    }

    /**
     *  The method shows the currency of the currency
     * @param $code char
     * @return integer|null
     */
    public function currencyCourse($code) {

        $currency = Currencies::find()
                ->select('rate')
                ->where('code = :code', [':code' => $code])
                ->one();

        if($currency)$currencyValue = (!$currency->rate) ? null : $currency->rate;
        else $currencyValue='';
        
        return $currencyValue;
    }
     
    /**
     *  The method exchange currency
     * @param $code char, $value integer
     * @return integer|0
     */
   
    public function currencyExchange($value = 0 ,$code) {

        $currency = Currencies::find()
                ->select('rate')
                ->where('code = :code', [':code' => $code])
                ->one();

        if($currency){ $currencyValue = (!$currency->rate) ? 0 : $value / $currency->rate;}
        else $currencyValue = 0;

        return $currencyValue;
    }

}
