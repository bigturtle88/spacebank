<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\LogMoneySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="log-money-search">

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
                    <div class="col-xs-2">
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
                    <div class="col-xs-2">
                        <?= $form->field($model, 'sum')->label(Yii::t('backend', 'Sum')) ?>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xs-4">
                    <?= $form->field($model, 'tip')->dropDownList([
                        '' => '',
                        'Buy Certificate' => Yii::t('backend', 'Buy Certificate'),
                        'Sell Certificate' => Yii::t('backend', 'Sell Certificate')
                    ])->label(Yii::t('backend', 'Type')) ?>
                    </div>
                    <div class="col-xs-4">
                    <?= $form->field($model, 'status')->dropDownList([
                        '' => '',
                        'Executed' => Yii::t('backend', 'Executed'),
                        'Canceled' => Yii::t('backend', 'Canceled')
                    ])->label(Yii::t('backend', 'Status')) ?>
                    </div> 
                    <div class="col-xs-4" style="margin-top:24px;">
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
