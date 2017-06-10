<?php

use common\models\Certificate;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use frontend\models\CertificateBuyForm;
use common\models\Order;
use yii\helpers\Url;
?>

<div class="col-xs-12">
    <p>
    <h2> <?= Yii::t('common', 'Orders') . ' ' . mb_strtolower(Yii::t('common', 'Buy'), 'utf-8') ?>  
    </h2>
</p>
</div>

<?php echo $this->render('/dashboard/dashboardTabs'); ?>

<?php
$form = ActiveForm::begin([
            'id' => $model->formName(),
            'enableAjaxValidation' => true,
            'validationUrl' => Url::toRoute('validation-order-buy-form'),
                //      'action' => Url::toRoute('order-buy-form'),
        ]);
?>
<div class="col-xs-12">
    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseAddCertificateBay" aria-expanded="false" aria-controls="collapseAddCertificateBay">
        <?= Yii::t('frontend', 'Add order'); ?>
    </button>

    <div class="collapse" id="collapseAddCertificateBay">
        <p>
        <div  class="col-xs-12" >
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading"><?= Yii::t('common', 'Parameters timeshare') ?></div>
                    <div class="panel-body">

                        <div class="input-group input-group-sm row">

                            <div class="col-xs-3">     
                                <?= $form->field($model, 'country_id')->dropDownList(common\models\Country::getCountryList()) ?>
                            </div> 
                            <div class="col-xs-3">   
                                <?= $form->field($model, 'club_id')->dropDownList(common\models\Club::getClubList()); ?> 

                            </div>        
                            <div class="col-xs-3">
                                <?= $form->field($model, 'apartment_type_id')->dropDownList(common\models\ApartmentType::getApartmentTypeList()); ?> 
                            </div>
                            <div class="col-xs-3">        
                                <?= $form->field($model, 'season_id')->dropDownList(common\models\Season::getSeasonList()); ?> 
                            </div>

                        </div>

                        <div class="input-group input-group-sm row">

                            <div class="col-xs-2">   
                                <?php //= $form->field($model, 'interval')->textInput() ?>    
                            </div>
                            <div class="col-xs-2"> 
                                <?php //= $form->field($model, 'interval_numbers')->textInput() ?>      
                            </div>    

                            <div class="col-xs-4">  
                                <?php //= $form->field($model, 'apartment_number')->textInput() ?></div>
                            <div class="col-xs-2"> <?php //= $form->field($model, 'bonus_weeks')->textInput()           ?>  </div>    


                        </div> 

                        <div class="input-group input-group-sm row">
                            <div class="col-xs-3">   
                                <?= $form->field($model, 'quantity')->textInput() ?>    
                            </div> 
                            <div class="col-xs-3">   
                                <?= $form->field($model, 'priced_value')->textInput() ?>    
                            </div>     
                            <div class="col-xs-3">

                                <?= $form->field($model, 'priced_currency')->dropDownList(common\models\CurrenciesQuery::getCurrenciesList())
                                ?> 
                            </div>
                            <?php if (Yii::$app->user->identity->user_type == common\models\User::TYPE_BROKER) { ?>

                                <div class="col-xs-3"> 
                                    <?php
                                    $me = [
                                        Yii::$app->user->identity->id =>
                                        Yii::$app->user->identity->username
                                    ];
                                    ?>
                                    <?php //= $form->field($model, 'price_show')->checkBox(['uncheck' => '0', 'value' => '1'])   ?>      

                                    <?= $form->field($model, 'user_id')->dropDownList(common\models\Broker::getUsersBroker(), $me) ?> 

                                </div>
                            <?php } ?>

                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('common', 'Save'), ['class' => 'btn btn-info', 'name' => 'signup-button']) ?>
                </div>
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
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="heading-<?= $order->id ?>  ">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-buy-<?= $order->id ?>" aria-expanded="true" aria-controls="collapse-buy-<?= $order->id ?> ">

                                <?= Yii::t('frontend', 'Pool') . ' №' . $order->id; ?>
                            </a>
                        </h4>
                    </div>
                    <div id="collapse-buy-<?= $order->id ?>" class="panel-collapse collapse collapse-buy in " role="tabpanel" aria-labelledby="heading-<?= $order->id ?> ">
                        <div class="panel-body">
                            <div class="row">

                                <div class="col-xs-4">
                                    <br>  <?= Yii::t('frontend', 'Country') . ': ' . $order->getCountry()->name ?> </br>
                                    <br>  <?= Yii::t('frontend', 'Club') . ': ' . $order->getClub()->name; ?> </br>
                                    <br>  <?= Yii::t('frontend', 'Apartment type') . ': ' . $order->getApartmentType()->name; ?> </br>
                                    <br>  <?= Yii::t('frontend', 'Season') . ': ' . $order->getSeason()->name; ?> </br>
                                    <br>  <?php //= Yii::t('frontend', 'Quantity') . ': ' . $order->quantity;          ?> </br>

                                </div>
                                <div class="col-xs-4">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        <?php } ?>


        </p>

    </div></div>
<?=
yii\widgets\LinkPager::widget([
    'pagination' => $pages,
]);
?>