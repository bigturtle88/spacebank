<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "log_deals".
 *
 * @property integer $id
 * @property integer $sum
 * @property integer $sum_system
 * @property integer $seller_id
 * @property integer $buyer_id
 * @property integer $certificate_id
 * @property integer $created_at
 * @property integer $updated_at
 */
class LogDeals extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%log_deals}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sum', 'sum_system', 'seller_id', 'buyer_id', 'certificate_id', 'created_at', 'updated_at'], 'required'],
            [['sum', 'sum_system', 'seller_id', 'buyer_id', 'certificate_id', 'created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'sum' => Yii::t('backend', 'Sum'),
            'sum_system' => Yii::t('backend', 'Sum System'),
            'seller_id' => Yii::t('backend', 'Seller ID'),
            'buyer_id' => Yii::t('backend', 'Buyer ID'),
            'certificate_id' => Yii::t('backend', 'Certificate ID'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),
        ];
    }
}
