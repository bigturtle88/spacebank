<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
/**
 * ContactForm is the model behind the contact form.
 */
class Club extends ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%clubs}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','is_active'],'required'],
            [['country'],'safe']
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * Get club list.
     *
     * @return array
     */
    public static function getClubList() {
        $club = Club::find()
                ->select(['id', 'name'])
                ->where(['is_active_server' => 1])
                ->orderBy('name ASC')
                ->all();

        return ArrayHelper::map($club, 'id', 'name');
    }

}
