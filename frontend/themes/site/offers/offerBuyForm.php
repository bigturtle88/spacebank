<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\web\Response;
use Yii;
?>

<div>

    <?php
    $order = common\models\Order::findOne($model->source_id);
    !$order ? $order = ' ' : $order = $order;

    $form = ActiveForm::begin([
                'id' => $model->formName(),
                'enableAjaxValidation' => true,
                'validationUrl' => Url::toRoute('validation-offer-buy-form'),
                'action' => Url::toRoute(['offers/offer-buy-form', 'id' => $model->source_id]),
    ]);
    ?>
    <div class="panel panel-default">
        <div class="panel-heading"><?= Yii::t('frontend', 'Parameter buy') ?></div>
        <div class="panel-body">

            <div class="input-group input-group-sm row">
                <div class="col-xs-12">       
                    <div class="row">
                        <div class="col-xs-3">     
                            <?= $form->field($model, 'source_id')->hiddenInput(['value' => $model->source_id])->label(Yii::t('frontend', 'Packages №') . $model->source_id) ?>
                        </div> 
                        <div class="col-xs-4">     
                            <?=
                            $form->field($model, 'bid', ['template' => "{label}\n<div class=\"input-group\">{input}\n<span class=\"input-group-addon\">" . $order->priced_currency . "</span></div>\n{hint}\n{error}"])
                            ?>

                        </div> 
                        <div class="col-xs-4">     
                            <?= $form->field($model, 'description')->textInput(); ?>
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


