<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \common\models\Country;
use nevermnd\places\PlacesAutocomplete;

/* @var $this yii\web\View */
/* @var $model common\models\Club */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="club-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_active')->checkbox() ?>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord() ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord() ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>