<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Offer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="offer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'seller_id')->textInput() ?>

    <?= $form->field($model, 'buyer_id')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'source_id')->textInput() ?>

    <?= $form->field($model, 'bid')->textInput() ?>

    <?= $form->field($model, 'expertise')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
