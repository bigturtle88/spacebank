<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\Season;

class SeasonForm extends Model 
{
    public $id;
	public $name;
	public $description;
	public $is_active;
    public $created_at;
    public $updated_at;


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

    /**
     * Season club.
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
        	$season  =  new Season();
    	}else{
    		$season = Season::findOne($this->id);
    	}
        $season->setAttributes($this->attributes);

        if($season->save()){
            $this->id = $season->id;
            return true;
        }

        return false;
    }

    public function delete(){
       Season::findOne($this->id)->delete();
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
            'description'=> Yii::t('backend', 'Description'), 
            'is_active'=> Yii::t('backend', 'Active'),
            'created_at'=> Yii::t('backend', 'Created at'),
            'updated_at'=> Yii::t('backend', 'Updated at') 
        ];
    }

}