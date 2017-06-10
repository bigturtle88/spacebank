<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TimeType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="apartment-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'block_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'days')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'penalty_seller')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'penalty_buyer')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord() ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord() ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
