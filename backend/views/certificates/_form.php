<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \common\models\Club;
use \common\models\Season;
use \common\models\ApartmentType;
use \common\models\Country;
use \common\models\Certificate;
use common\models\Company;
use dosamigos\datepicker\DatePicker;
use common\models\CurrenciesQuery;

/* @var $this yii\web\View */
/* @var $model common\models\Certificate */
/* @var $form yii\widgets\ActiveForm */
?>

<div>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'certificate_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'start_date')->widget(DatePicker::className(),[
        'template' => '{addon}{input}',
        'clientOptions' => [
        'autoclose' => true,
        'format' => 'yyyy-m-dd'
        ]
    ]); ?>

    <?= $form->field($model, 'end_date')->widget(DatePicker::className(),[
        'template' => '{addon}{input}',
        'clientOptions' => [
        'autoclose' => true,
        'format' => 'yyyy-m-dd'
        ]
    ]); ?>

    <?= $form->field($model, 'certificate_period')->dropDownList(array(''=>'') + Certificate::$CERTIFICATE_PERIOD_ARRAY) ?>
    
    <?= $form->field($model, 'contract_code')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'contract_date')->widget(DatePicker::className(),[
        'template' => '{addon}{input}',
        'clientOptions' => [
        'autoclose' => true,
        'format' => 'yyyy-m-dd'
        ]
    ]); ?>

    <?= $form->field($model, 'certificate_sum')->textInput() ?>

    <?= $form->field($model, 'certificate_currency')->dropDownList(array(''=>'') + CurrenciesQuery::getCurrenciesList()) ?>

    <?= $form->field($model, 'country_id')->dropDownList(array(''=>'') + Country::getCountryList()) ?>
    
    <?= $form->field($model, 'club_id')->dropDownList(array(''=>'') + Club::getClubList()) ?>
    
    <?= $form->field($model, 'apartment_type_id')->dropDownList(array(''=>'') + ApartmentType::getApartmentTypeList()) ?>

    <?= $form->field($model, 'season_id')->dropDownList(array(''=>'') + Season::getSeasonList()) ?>
    
    <?= $form->field($model, 'company_id')->dropDownList(array(''=>'') + Company::getCompanyList()) ?>

    <?= $form->field($model, 'interval')->textInput() ?>

    <?= $form->field($model, 'interval_numbers')->textInput() ?>

    <?= $form->field($model, 'apartment_number')->textInput() ?>

    <?= $form->field($model, 'bonus_weeks')->textInput() ?>

    <?= $form->field($model, 'points')->textInput() ?>

    <?= $form->field($model, 'fees_start_sum')->textInput() ?>

    <?= $form->field($model, 'fees_start_currency')->dropDownList(array(''=>'') + CurrenciesQuery::getCurrenciesList()) ?>

    <?= $form->field($model, 'fees_current_sum')->textInput() ?>

    <?= $form->field($model, 'fees_current_currency')->dropDownList(array(''=>'') + CurrenciesQuery::getCurrenciesList()) ?>

    <?= $form->field($model, 'is_penalty')->textInput() ?>

    <?= $form->field($model, 'penalty_start_sum')->textInput() ?>

    <?= $form->field($model, 'penalty_start_currency')->dropDownList(array(''=>'') + CurrenciesQuery::getCurrenciesList()) ?>

    <?= $form->field($model, 'fees_loan_sum')->textInput() ?>

    <?= $form->field($model, 'fees_loan_currency')->dropDownList(array(''=>'') + CurrenciesQuery::getCurrenciesList()) ?>

    <?= $form->field($model, 'certificate_loan_sum')->textInput() ?>

    <?= $form->field($model, 'certificate_loan_currency')->dropDownList(array(''=>'') + CurrenciesQuery::getCurrenciesList()) ?>

    <?= $form->field($model, 'is_membership')->checkbox() ?>
    
    <?= $form->field($model, 'is_expertize')->checkbox() ?>

    <?= $form->field($model, 'is_priced')->checkbox() ?>
    
    <?= $form->field($model, 'priced_sum')->textInput() ?>

    <?= $form->field($model, 'priced_currency')->dropDownList(array(''=>'') + CurrenciesQuery::getCurrenciesList()) ?>

    <?= $form->field($model, 'is_approved')->checkbox() ?>

    <?= $form->field($model, 'is_archive')->checkbox() ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord() ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord() ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
