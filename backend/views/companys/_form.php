<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \common\models\Country;

/* @var $this yii\web\View */
/* @var $model common\models\Company */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'country')->dropDownList(array(''=>'') + Country::getCountryListByName()) ?>

    <?= $form->field($model, 'info')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->textInput() ?>
    
    <?= $form->field($model, 'is_active')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord() ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord() ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
