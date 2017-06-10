<?php

namespace common\models;

use yii\helpers\ArrayHelper;
use Yii;

/**
 * This is the model class for table "{{%packages}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $club_id

 * @property string $company
 * @property string $apartment_type_id
 * @property string $certificate_period
 * @property string $season_id
 * @property integer $quantity
 * @property integer $priced_sum
 * @property string $priced_currency
 * @property integer $is_active
 * @property integer $is_blocked
 * @property string $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $virtual
 */
class Packages extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%packages}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['user_id', 'club_id', 'country_id', 'quantity', 'created_at', 'updated_at'], 'required'],
                [['user_id', 'club_id', 'quantity', 'is_active', 'is_blocked', 'created_at', 'updated_at', 'virtual'], 'integer'],
                [['company', 'apartment_type_id', 'certificate_period', 'season_id', 'status'], 'string', 'max' => 255],
                [['priced_currency'], 'string', 'max' => 3],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('common', 'ID'),
            'user_id' => Yii::t('backend', 'User ID'),
            'club_id' => Yii::t('backend', 'Club Name'),
            'country_id' => Yii::t('backend', 'Country'),
            'company' => Yii::t('backend', 'Company'),
            'apartment_type_id' => Yii::t('backend', 'Apartment Type'),
            'certificate_period' => Yii::t('backend', 'Certificate period'),
            'season_id' => Yii::t('backend', 'Season'),
            'quantity' => Yii::t('common', 'Number of certificates'),
            'priced_sum' => Yii::t('backend', 'Priced sum'),
            'priced_currency' => Yii::t('backend', 'Currency'),
            'is_active' => Yii::t('backend', 'Active'),
            'is_blocked' => Yii::t('common', 'Blocked'),
            'status' => Yii::t('backend', 'Status'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),
            'virtual' => Yii::t('backend', 'Virtual'),
        ];
    }

    /**
     * Get Packages Object list.
     *
     * @return array
     */
    public static function getPackagesList() {

        $clients_id = Broker::find()->select(['user_id'])
                        ->where(['broker_id' => Yii::$app->user->identity->id])->column();

        $packages = Packages::find()
                ->select(['id'])
                ->where(['user_id' => Yii::$app->user->identity->id])
                ->orFilterWhere(['user_id' => $clients_id])
                ->all();

        return ArrayHelper::map($packages, 'id', 'id');
    }

}
