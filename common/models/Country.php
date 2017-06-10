<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
 
class Country extends ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%countries}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public function rules()
    {
        return [
        	[['name','full_name','iso_3166','is_active'],'required'],
        	[['created_at','updated_at'],'safe']
        ];
    }
    /**
     * Get country list.
     *
     * @return array
     */
    public static function getCountryList() {
        $countries = Country::find()
                ->select(['id', 'name'])
                ->orderBy('name')
                ->where('is_active > 0')
                ->all();

        return ArrayHelper::map($countries, 'id', 'name');
    }
    
    public static function getCountryListByName() {
        $countries = Country::find()
                ->select(['id', 'name'])
                ->orderBy('name')
                ->where('is_active > 0')
                ->all();

        return ArrayHelper::map($countries, 'name', 'name');
    }

}
