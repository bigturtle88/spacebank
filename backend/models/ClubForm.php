<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\Club;

class ClubForm extends Model 
{

	public $id;
	public $name;
	public $country;
	public $is_active;


	 /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        	[['name','is_active'],'required'],
        	[['id','country'],'safe']
        ];
    }

    /**
     * Save club.
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
        	$club  =  new Club();
    	}else{
    		$club = Club::findOne($this->id);
    	}
        $club->setAttributes($this->attributes);

        return $club->save() ? true : false;
    }

    public function delete(){
       Club::findOne($this->id)->delete();
    }


    public function isNewRecord(){
        return is_null($this->id) ? true : false;
    }

    /*
      * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'name' => Yii::t('backend', 'Name'),
            'country'=> Yii::t('backend', 'Adres'), 
            'is_active'=> Yii::t('backend', 'Active'),
            'created_at'=> Yii::t('backend', 'Created at'),
            'updated_at'=> Yii::t('backend', 'Updated at') 
        ];
    }

}