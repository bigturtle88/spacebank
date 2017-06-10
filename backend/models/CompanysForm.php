<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\Company;

class CompanysForm extends Model 
{
	public $id;
	public $name;
	public $country;
	public $info;
	public $type;
	public $created_at;
        public $updated_at;
        public $is_active;

	/**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        	[['name','country','info','type','is_active'],'required'],
        	[['id','created_at','updated_at'],'safe']
        ];
    }


    /**
     * Save company.
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
        	$company  =  new Company();
    	}else{
    		$company = Company::findOne($this->id);
    	}
        $company->setAttributes($this->attributes);

        return $company->save() ? true : false;
    }


    public function delete(){
       Company::findOne($this->id)->delete();
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
            'country'=> Yii::t('backend', 'Country'), 
            'info'=> Yii::t('backend', 'Info'),
            'type'=> Yii::t('backend', 'Type'),
            'is_active'=> Yii::t('backend', 'Active'),
            'created_at'=> Yii::t('backend', 'Created at'),
            'updated_at'=> Yii::t('backend', 'Updated at') 
        ];
    }


}