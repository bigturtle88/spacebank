<?php

use common\models\Certificate;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use common\models\Order;
use yii\helpers\Url;
?>

<div class="col-xs-12">
    <p>
    <h2><?= Yii::t('common', 'Orders') . ' ' . mb_strtolower(Yii::t('common', 'Sell'), 'utf-8') ?>   
    </h2>
</p>
</div>

<?php echo $this->render('/dashboard/dashboardTabs'); ?>


<div class="col-xs-12">

    <?php
    $form = ActiveForm::begin([
                'id' => $model->formName(),
                'enableAjaxValidation' => true,
                'validationUrl' => Url::toRoute('validation-order-sell-form'),
                    //    'action' => Url::toRoute('order-sell-form'),
    ]);
    ?>
    <p>

        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseAddPackagesSell" aria-expanded="false" aria-controls="collapseAddPackagesSell">
            <?= Yii::t('frontend', 'Add order'); ?>
        </button>
    </p>

    <div class="collapse" id="collapseAddPackagesSell">
        <p>
        <div  class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading"><?= Yii::t('common', 'Parameters timeshare') ?></div>
                <div class="panel-body">

                    <div class="input-group input-group-sm row">
                        <div class="col-xs-12">  
                            <div class="row">
                                <div class="col-xs-4">     
                                    <?= $form->field($model, 'source_id')->dropDownList(common\models\Packages::getPackagesList()) ?>
                                </div> 
                                <div class="col-xs-2">   
                                    <?= $form->field($model, 'priced_value')->textInput() ?>    
                                </div>     
                                <div class="col-xs-2">
                                    <?= $form->field($model, 'priced_currency')->dropDownList(common\models\CurrenciesQuery::getCurrenciesList()) ?> 
                                </div>
                                <div class="col-xs-2"> 
                                    <?= $form->field($model, 'price_show')->checkBox(['uncheck' => '0', 'value' => '1']) ?>      
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
        <p>
    </div>
</div>    




<div class="col-xs-12">
    <div class="row">
        <p>
            <?php foreach ($orders as $order) { ?>      
            <div class="panel-group" id="accordion-<?= $order->id ?>  " role="tablist" aria-multiselectable="true">
                <div class="panel
                <?php if (!is_null($order->id)) { ?>
                         panel-default">
                     <?php } else { ?>
                        panel-warning">
                    <?php } ?>
                    <div class="panel-heading" role="tab" id="heading-<?= $order->id ?>  ">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-sell-<?= $order->id ?>" aria-expanded="true" aria-controls="collapse-<?= $order->id ?> ">

                                <?= Yii::t('frontend', 'Pool') . ' №' . $order->id; ?>
                            </a>
                        </h4>
                    </div>
                    <div id="collapse-sell-<?= $order->id ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading-<?= $order->id ?> ">
                        <div class="panel-body">
                            <div class="row"><?php if (!is_null($order->id)) { ?>
                                    <div class="col-xs-5">
                                        <br>  <?= Yii::t('frontend', 'Code of packages') . ': ' . $order->source_id ?> </br>
                                        <br>  <?= Yii::t('frontend', 'Country') . ': ' . substr(Order::getCountryString($order->country_id), 0, 10) . '...' ?> </br>
                                        <br>  <?= Yii::t('frontend', 'Apartment type') . ': ' . substr(Order::getApartmentTypeString($order->apartment_type_id), 0, 10) . '...' ?> </br>
                                        <br> <?php if ($order->type == Order::TYPE_SELL) { ?>   
                                            <?= Yii::t('frontend', 'Quantity of certificate') . ': ' . $order->getQuantityCertificate()->quantity ?> 
                                        <?php } ?> 
                                        </br>

                                    </div>
                                    <div class="col-xs-5">     
                                        <br>  <?= Yii::t('frontend', 'Club') . ': ' . substr($order->getClub()->name, 0, 20) . '...' ?> </br>
                                        <br>  <?= Yii::t('frontend', 'Price') . ': ' . $order->priced_value . '  ' . $order->priced_currency; ?> </br>
                                        <br>  <?= Yii::t('frontend', 'Season') . ': ' . substr(Order::getSeasonString($order->season_id), 0, 20) . '...' ?> </br>
                                    </div> 
                                <?php } else {
                                    ?>
                                    <div class="col-xs-12">  <br> Пакет удален!  </br>      </div>
                                    <?php }
                                    ?>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        <?php } ?>


        </p>
    </div>
</div>

<?=
yii\widgets\LinkPager::widget([
    'pagination' => $pages,
]);
?>