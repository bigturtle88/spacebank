<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="col-xs-12">
    <p>
    <h2> <?= Yii::t('common', 'Profile') ?></h2>
</p>
</div>

<?php echo $this->render('/dashboard/dashboardTabs'); ?>
<div class="profileform-wrapper">

    <?php
    ?>

    <?php
    $form = ActiveForm::begin([
                'id' => $model->formName(),
                'enableAjaxValidation' => true,
                'validationUrl' => Url::toRoute('validation-profile-form'),
 
    ]);
    ?>


    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'fio')->textInput() ?>

    <?= $form->field($model, 'tel')->textInput() ?>

    <?= $form->field($model, 'is_individual')->checkBox(['class' => 'isFirm', 'onchange' => 'isFirm(this);']) ?>
    <div class="is_firm">
        <?= $form->field($model, 'contact')->textInput() ?>

        <?= $form->field($model, 'firm_name')->textInput() ?>                
    </div>
    <div class="form-group">


        <?= Html::submitButton(Yii::t('common', 'Save'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>