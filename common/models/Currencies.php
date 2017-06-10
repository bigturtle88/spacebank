<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%currencies}}".
 *
 * @property integer $id
 * @property string $code
 * @property decimal $rate
 * @property string $name
 */
class Currencies extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%currencies}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rate','is_active'], 'required'],
            [['rate'], 'number', 'min' => 0],
            [['code'], 'string', 'max' => 3],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'code' => Yii::t('backend', 'Currency Code'),
            'rate' => Yii::t('backend', 'Currency Rate'),
            'name' => Yii::t('backend', 'Name'),
            'is_active'=> Yii::t('backend', 'Active'),
        ];
    }

}
