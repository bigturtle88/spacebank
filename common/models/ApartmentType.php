<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
/**
 * ContactForm is the model behind the contact form.
 */
class ApartmentType extends ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%apartment_types}}';
    }


     /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','description','is_active'],'required'],
            [['id','created_at','updated_at'],'safe']
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * Get apartment type list.
     *
     * @return array
     */
    public static function getApartmentTypeList() {
        $apartmentType = ApartmentType::find()
                ->select(['id', 'name'])
                ->all();

        return ArrayHelper::map($apartmentType, 'id', 'name');
    }

}
