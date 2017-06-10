<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

class FinanceModel extends ActiveRecord {

    public $theme;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%config}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key', 'value'], 'safe'],
        ];
    }

    /**
     * Get order times list.
     *
     * @return array
     */
    public static function getFinanceList() {
        $finance = FinanceModel::find()
                ->select(['key', 'value', 'description'])
                ->where(['category'=>'finance'])
                ->all();

        return $finance;
    }
    
    public static function saveFinance($k,$v)
    {
        if( Yii::$app->db->createCommand()->update('config', ['value' => $v], "key = '$k'")->execute()){
            return true;
        }

        return false;
    }

}
