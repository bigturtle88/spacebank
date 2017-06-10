<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\Times;

class TimesForm extends Model 
{
	public $id;
	public $block_number;
	public $days;
        public $penalty_seller;
        public $penalty_buyer;


     /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        	[['block_number','days','penalty_seller','penalty_buyer'],'required'],
        	[['id'],'safe']
        ];
    }


     /**
     * Order times.
     *
     * @return true|null the saved model or null if saving fails
     */
    public function save()
    {
        if (!$this->validate())
        {
            return false;
        }
        if(is_null($this->id)){
        	$Times  =  new Times();
    	}else{
    		$Times = Times::findOne($this->id);
    	}
        $Times->setAttributes($this->attributes);

        if($Times->save()){
            $this->id = $Times->id;
            return true;
        }

        return false;
    }

    public function delete(){
       Times::findOne($this->id)->delete();
    }


    public function isNewRecord(){
        return is_null($this->id) ? true : false;
    }

    /*
      * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'block_number' => Yii::t('common', 'Number of certificates'),
            'days'=> Yii::t('backend', 'Number of days'),
            'penalty_seller'=> Yii::t('backend', 'Penalty to seller'),
            'penalty_buyer'=> Yii::t('backend', 'Penalty to buyer')
        ];
    }
}