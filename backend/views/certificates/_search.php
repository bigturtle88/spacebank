<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \common\models\Club;
use common\models\CurrenciesQuery;
use \common\models\Season;
use \common\models\ApartmentType;
use \common\models\Country;
use common\models\Company;
use \common\models\Certificate;

/* @var $this yii\web\View */
/* @var $model backend\models\PackagesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="packages-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div  class="col-xs-12">
    <div class="panel panel-default">
        <div class="panel-heading"><?= Yii::t('frontend', 'Search') ?></div>
        <div class="panel-body">


            <div class="input-group input-group-sm ">
                <div class="row">
                    <div class="col-xs-2">
                        <?= $form->field($model, 'id') ?>
                    </div> 
                    <div class="col-xs-5">
                        <?= $form->field($model, 'user_id')->label(Yii::t('backend', 'User')) ?>
                    </div> 
                    
                    <div class="col-xs-5">
                        <?= $form->field($model, 'certificate_period')->dropDownList(array(''=>'') + Certificate::$CERTIFICATE_PERIOD_ARRAY)->label(Yii::t('backend', 'Certificate period')) ?>
                    </div>
                    
                </div>
                
                <div class="row">
                    <div class="col-xs-3">
                        <?= $form->field($model, 'status')->dropDownList([
                        '' => '',
                        'For sale' => Yii::t('common', 'For sale'),
                        'Blocked' => Yii::t('common', 'Blocked'),
                        'Sold' => Yii::t('common', 'Sold'),
                        ])->label(Yii::t('backend', 'Status')) ?>
                        
                    </div>
                    <div class="col-xs-2">
                    <?= $form->field($model, 'priced_sum')->label(Yii::t('backend', 'Priced sum')) ?>
                    </div>
                    <div class="col-xs-2">
                    <?= $form->field($model, 'priced_currency')->dropDownList(array(''=>'') + CurrenciesQuery::getCurrenciesList())->label(Yii::t('backend', 'Currency')) ?>
                    </div>
                    <div class="col-xs-5">
                    <?= $form->field($model, 'club_id')->dropDownList(array(''=>'') + Club::getClubList())->label(Yii::t('backend', 'Club Name')) ?>
                    </div> 
                    
                    
                </div>
                <div class="row">
                    <div class="col-xs-3">
                        <?= $form->field($model, 'country_id')->dropDownList(array(''=>'') + Country::getCountryList())->label(Yii::t('backend', 'Country')) ?>
                    </div>
                    <div class="col-xs-3">
                        <?= $form->field($model, 'company')->dropDownList(array(''=>'') + Company::getCompanyList())->label(Yii::t('backend', 'Company')) ?>
                    </div>
                    <div class="col-xs-3">
                        <?= $form->field($model, 'apartment_type_id')->dropDownList(array(''=>'') + ApartmentType::getApartmentTypeList())->label(Yii::t('backend', 'Apartment Type')) ?>
                    </div>
                    <div class="col-xs-3">
                        <?= $form->field($model, 'season_id')->dropDownList(array(''=>'') + Season::getSeasonList())->label(Yii::t('backend', 'Season')) ?>
                    </div> 
                    
                    
                </div>
                <div class="row">
                    <div class="col-xs-3" style="margin-top:24px;">
                        <?= $form->field($model, 'is_approved')->checkbox(['label' => Yii::t('backend', 'Approved')]) ?>
                    </div>
                    <div class="col-xs-3" style="margin-top:24px;">
                        <?= $form->field($model, 'is_archive')->checkbox(['label' => Yii::t('backend', 'Archive')]) ?>
                    </div>
                    
                    <div class="col-xs-6" style="margin-top:24px;">
                        <?= Html::submitButton(Yii::t('backend', 'Search'), ['class' => 'btn btn-primary']) ?>
                        <?= Html::resetButton(Yii::t('backend', 'Reset'), ['class' => 'btn btn-default']) ?>
                    </div>  
                    
                </div>
            </div>
         </div>
    </div>
</div>


    <?php ActiveForm::end(); ?>

</div>
