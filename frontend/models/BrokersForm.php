<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use common\models\Packages;
use common\models\CurrenciesQuery;
use common\models\Broker;

class BrokersForm extends Model {

    public $brokers_id;
    public $procents;

    public function rules() {
        return [
                ['brokers_id', 'each', 'rule' => ['integer']],
        ];
    }

    public function save() {

        Broker::updateAll(['is_active' => Broker::STATUS_INACTIVE], 'is_active = ' . Broker::STATUS_ACTIVE . ' and user_id = ' . Yii::$app->user->identity->id);

        foreach ($this->brokers_id as $broker) {

            $brokers = Broker::find()->where(['broker_id' => $broker, 'user_id' => Yii::$app->user->identity->id])->one();
            
            if (!$brokers) {
                $brokers = new Broker();
            }
            $brokers->user_id = Yii::$app->user->identity->id;
            $brokers->broker_id = $broker;

            $brokers->procent = $this->procents[$broker] ? $this->procents[$broker] : 1;
            $brokers->is_active = Broker::STATUS_ACTIVE;
            if (!$brokers->save()) {
                return false;
            }
        }
        return true;
    }

}
