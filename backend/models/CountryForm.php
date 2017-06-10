<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\Country;

class CountryForm extends Model 
{
	public $id;
	public $name;
	public $full_name;
	public $iso_3166;
	public $is_active;
	public $created_at;
  	public $updated_at;

  	/**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        	[['name','full_name','iso_3166','is_active'],'required'],
        	[['id','created_at','updated_at'],'safe']
        ];
    }


    /**
     * Save country.
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
        	$company  =  new Country();
    	}else{
    		$company = Country::findOne($this->id);
    	}
        $company->setAttributes($this->attributes);

        return $company->save() ? true : false;
    }

    public function delete(){
       Country::findOne($this->id)->delete();
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
            'full_name'=> Yii::t('backend', 'Full Name'), 
            'iso_3166'=> Yii::t('backend', 'ISO Name'),
            'is_active'=> Yii::t('backend', 'Active'),
            'created_at'=> Yii::t('backend', 'Created at'),
            'updated_at'=> Yii::t('backend', 'Updated at') 
        ];
    }

}