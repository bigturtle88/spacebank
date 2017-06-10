<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
/**
 * ContactForm is the model behind the contact form.
 */
class Season extends ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%seasons}}';
    }

        public function rules()
    {
        return [
            [['name','description','is_active'],'required'],
            [['id'],'safe']
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * Get season type list.
     *
     * @return array
     */
    public static function getSeasonList() {
        $season =  Season::find()
                ->select(['id', 'name'])
                ->all();

        return ArrayHelper::map($season, 'id', 'name');
    }

}
