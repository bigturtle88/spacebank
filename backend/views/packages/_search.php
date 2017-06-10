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
                    <div class="col-xs-4">
                        <?= $form->field($model, 'user_id')->label(Yii::t('backend', 'User')) ?>
                    </div> 
                    <div class="col-xs-3">
                    <?=
                    $form->field($model, 'created_at')->widget(\dosamigos\datepicker\DatePicker::className(), [
                        'template' => '{addon}{input}',
                        'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                        ]
                    ])->label(Yii::t('backend', 'Created From'))
                    ?>
                    </div>
                    <div class="col-xs-3">
                    <?=
                    $form->field($model, 'updated_at')->widget(\dosamigos\datepicker\DatePicker::className(), [
                        'template' => '{addon}{input}',
                        'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                        ]
                    ])->label(Yii::t('backend', 'Created To'))
                    ?>
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
                    <?= $form->field($model, 'priced_sum') ?>
                    </div>
                    <div class="col-xs-2">
                    <?= $form->field($model, 'priced_currency')->dropDownList(array(''=>'') + CurrenciesQuery::getCurrenciesList()) ?>
                    </div>
                    <div class="col-xs-5">
                    <?= $form->field($model, 'club_id')->dropDownList(array(''=>'') + Club::getClubList()) ?>
                    </div> 
                    
                    
                </div>
                <div class="row">
                    <div class="col-xs-3">
                        <?= $form->field($model, 'country_id')->dropDownList(array(''=>'') + Country::getCountryList()) ?>
                    </div>
                    <div class="col-xs-3">
                        <?= $form->field($model, 'company')->dropDownList(array(''=>'') + Company::getCompanyList()) ?>
                    </div>
                    <div class="col-xs-3">
                        <?= $form->field($model, 'apartment_type_id')->dropDownList(array(''=>'') + ApartmentType::getApartmentTypeList()) ?>
                    </div>
                    <div class="col-xs-3">
                        <?= $form->field($model, 'season_id')->dropDownList(array(''=>'') + Season::getSeasonList()) ?>
                    </div> 
                    
                    
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <?= $form->field($model, 'certificate_period')->dropDownList(array(''=>'') + Certificate::$CERTIFICATE_PERIOD_ARRAY) ?>
                    </div>
                    <div class="col-xs-2" style="margin-top:24px;">
                        <?= $form->field($model, 'is_active')->checkbox() ?>
                    </div>
                    <div class="col-xs-3" style="margin-top:24px;">
                        <?= $form->field($model, 'is_blocked')->checkbox() ?>
                    </div>
                    <div class="col-xs-3" style="margin-top:24px;">
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
