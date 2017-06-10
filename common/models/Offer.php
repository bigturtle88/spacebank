<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Offer extends ActiveRecord {

    const STATUS_NEW = 1;
    const STATUS_OK = 2;
    const STATUS_REJECT = 3;
    const STATUS_TIMEOUT = 4;
    const STATUS_CANCEL = 5; //Пользователь отменяет, свою сделку
    const STATUS_FINISH = 7; //Пользователь провел седлку
    const STATUS_TRADE = 8; //Ведет торговлю
    const STATUS_PENDING = 9; //В ожидание только для трейдера

    public static function getStatuses() {
        return [
            self::STATUS_NEW => 'new',
            self::STATUS_OK => 'ok',
            self::STATUS_REJECT => 'reject',
            self::STATUS_TIMEOUT => 'timeout',
            self::STATUS_CANCEL => 'cancel',
            self::STATUS_TRADE => 'trade',
            self::STATUS_PENDING => 'pending'
        ];
    }

    public function getStatus($id = null, $tranlate = false) {

        $statuses = self::getStatuses($tranlate);

        if (isset($statuses[$id])) {

            return $statuses[$id];
        }
        return null;
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%offers}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [[
            'seller_id',
            'buyer_id',
            'user_id',
            'status', 'source_id', 'author_id',
            'bid',
            'expertise',
            'created_at',
            'updated_at','type'
                ], 'required'], ['description', 'string', 'max' => 255]
        ];
    }

  
}
