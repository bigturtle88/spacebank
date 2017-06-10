<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
/**
 * TimesForm is the model behind the contact form.
 */
class Times extends ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%order_times}}';
    }


     /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['block_number','days','penalty_seller','penalty_buyer'],'required']
        ];
    }

    public function behaviors()
    {
        return [
            
        ];
    }

    /**
     * Get order times list.
     *
     * @return array
     */
    public static function getTimesList() {
        $times = Times::find()
                ->select(['id', 'block_number', 'days','penalty_seller','penalty_buyer'])
                ->all();

        return ArrayHelper::map($times, 'id', 'block_number', 'block_number');
    }

}
