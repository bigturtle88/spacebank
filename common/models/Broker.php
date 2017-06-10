<?php

namespace common\models;

use Yii;
use common\models\User;
use yii\helpers\ArrayHelper;
use yii\db\Query;

/**
 * This is the model class for table "{{%broker}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $broker_id
 * @property integer $consolidator_id
 * @property integer $procent
 * @property integer $is_active
 */
class Broker extends \yii\db\ActiveRecord {

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public $broker;
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%broker}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['user_id', 'broker_id', 'consolidator_id', 'procent', 'is_active'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('common', 'ID'),
            'user_id' => Yii::t('common', 'User'),
            'broker_id' => Yii::t('common', 'Broker'),
            'consolidator_id' => Yii::t('common', 'Consolidator'),
            'procent' => Yii::t('common', 'Procent'),
            'is_active' => Yii::t('backend', 'Active'),
        ];
    }

    /* get list of all brokers - for users and for consolidators */

    public static function getBrokersList() {
        $brokers = User::find()
                ->select(['id', 'login'])
                ->where(['user_type' => User::TYPE_BROKER])
                ->all();
        return ArrayHelper::map($brokers, 'id', 'login');
    }

    /* get list of brokers, set for current user */

    public static function getUserBrokersList($user_id) {
        $brokers = Broker::find()
                ->select(['broker_id', 'procent'])
                ->where(['user_id' => $user_id, 'is_active' => 1])
                ->andWhere(['>', 'broker_id', 0])
                ->all();
        return ArrayHelper::map($brokers, 'broker_id', 'procent');
    }

    /* get list of users, set for current broker */

    public static function getUsersList($broker_id) {
        $brokers = Broker::find()
                ->select(['user_id', 'procent'])
                ->where(['broker_id' => $broker_id, 'is_active' => 1])
                ->andWhere(['>', 'user_id', 0])
                ->all();
        return ArrayHelper::map($brokers, 'user_id', 'procent');
    }

    /* get list of consolidators, set for current broker */

    public static function getConsolidatorsList($broker_id) {
        $brokers = Broker::find()
                ->select(['consolidator_id', 'procent'])
                ->where(['broker_id' => $broker_id, 'is_active' => 1])
                ->andWhere(['>', 'consolidator_id', 0])
                ->all();
        return ArrayHelper::map($brokers, 'user_id', 'procent');
    }

    public function getUsersBroker() {

        $clients = Broker::find()->select(['user_id'])
                        ->where(['broker_id' => Yii::$app->user->identity->id])->column();

  
        $users = (new Query())->select(['id', 'username'])
                ->from('user')
                ->where(['user.id' =>  $clients ])
                ->all();


        return ArrayHelper::map($users, 'id', 'username');
    }

}
