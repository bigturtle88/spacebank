<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\CurrenciesQuery;

/* @var $this yii\web\View */
/* @var $model backend\models\LogDealsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="log-deals-search">

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
                        <?= $form->field($model, 'seller_id')->label(Yii::t('backend', 'Seller')) ?>
                    </div> 
                    <div class="col-xs-2">
                        <?= $form->field($model, 'buyer_id')->label(Yii::t('backend', 'Buyer')) ?>
                    </div> 
                    
                </div>
                
                <div class="row">
                    <div class="col-xs-3">
                        <?= $form->field($model, 'priced_value')->label(Yii::t('backend', 'Deal price')) ?>
                    </div>
                    <div class="col-xs-2">
                        <?= $form->field($model, 'priced_currency')->dropDownList(array(''=>'') + CurrenciesQuery::getCurrenciesList())->label(Yii::t('backend', 'Currency')) ?>
                    </div>
                    <div class="col-xs-3">
                        <?= $form->field($model, 'packages_id')->label(Yii::t('backend', 'Package ID')) ?>
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
