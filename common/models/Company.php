<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
 
class Company extends ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%company}}';
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
            [['name','country','is_active'],'required'],
            [['info','type'],'safe']
        ];
    }
    
    /**
     * Get club list.
     *
     * @return array
     */
    public static function getCompanyList() {
        $company = Company::find()
                ->select(['id', 'name'])
                ->all();

        return ArrayHelper::map($company, 'id', 'name');
    }

}
