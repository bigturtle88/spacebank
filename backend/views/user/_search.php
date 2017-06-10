<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-search">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>

    <div  class="col-xs-12">
    <div class="panel panel-default">
        <div class="panel-heading"><?= Yii::t('frontend', 'Search') ?></div>
        <div class="panel-body">


            <div class="input-group input-group-sm ">
                <div class="row">
                    <div class="col-xs-2">
                        <?= $form->field($model, 'id') ?>
                    </div> 
                    <div class="col-xs-3">
                        <?= $form->field($model, 'username')->label(Yii::t('backend', 'User')) ?>
                    </div> 
                    
                    <div class="col-xs-3">
                        <?= $form->field($model, 'email')->label(Yii::t('backend', 'Email')) ?>
                    </div>
                    <div class="col-xs-4">
                        <?= $form->field($model, 'fio')->label(Yii::t('backend', 'FIO')) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <?= $form->field($model, 'tel')->label(Yii::t('backend', 'Phone number')) ?>
                    </div> 
                    
                    <div class="col-xs-4">
                        <?= $form->field($model, 'contact')->label(Yii::t('backend', 'Contact name')) ?>
                    </div>
                    <div class="col-xs-4">
                        <?= $form->field($model, 'firm_name')->label(Yii::t('backend', 'Firm name')) ?>
                    </div>
                    
                </div>
                
                <div class="row">
                    <div class="col-xs-4">
                    <?= $form->field($model, 'user_type')->dropDownList([
                            '' => '',
                            'User' => Yii::t('common', 'User'),
                            'Broker' => Yii::t('common', 'Broker'),
                            'Consolidator' => Yii::t('common', 'Consolidator')
                        ])->label(Yii::t('backend', 'Status')) ?>
                    </div>
                    <div class="col-xs-4" style="margin-top:24px;">
                        <?= $form->field($model, 'is_individual')->checkbox(['label' => Yii::t('backend', 'Individual')]) ?>
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


    <div class="form-group">
<?= Html::submitButton(Yii::t('backend', 'Search'), ['class' => 'btn btn-primary']) ?>
    <?= Html::resetButton(Yii::t('backend', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
