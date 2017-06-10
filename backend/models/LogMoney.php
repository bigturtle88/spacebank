<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "log_money".
 *
 * @property integer $id
 * @property integer $sum
 * @property integer $created_at
 * @property integer $updated_at
 * @property varchar $tip
 * @property varchar $status
 */
class LogMoney extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%log_money}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'status' => Yii::t('backend', 'Status'),
        ];
    }
}
