<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\web\Response;

$dropDownListDefult = [
    'prompt' => 'Выбрать...'
];
?>

<div>

    <?php
    $form = ActiveForm::begin([
                'id' => $model->formName(),
                'enableAjaxValidation' => true,
                'validationUrl' => Url::toRoute('validation-offer-sell-form'),
                'action' => Url::toRoute(['offers/offer-sell-form', 'id' => $model->order_id]),
    ]);
    ?>
    <div class="panel panel-default">
        <div class="panel-heading"><?= Yii::t('frontend', 'Parameter sell') ?></div>
        <div class="panel-body">

            <div class="input-group input-group-sm row">
                <div class="col-xs-12">       
                    <div class="row">
                        <div class="col-xs-4">     
                            <?= $form->field($model, 'source_id')->dropDownList(common\models\Packages::getPackagesList() , $dropDownListDefult) ?>
                        </div> 

                        <div class="col-xs-4">     
                            <?= $form->field($model, 'bid')->textInput(); ?> 
                        </div> 
                         <div class="col-xs-2"> 
                            <?= $form->field($model, 'priced_currency')->dropDownList(common\models\CurrenciesQuery::getCurrenciesList()) ?>
                        </div> 
                        <div class="col-xs-12">     
                            <?= $form->field($model, 'description')->textArea(); ?>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('common', 'Save'), ['class' => 'btn btn-info', 'name' => 'signup-button']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>


