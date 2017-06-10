<?php
/* @var $this yii\web\View */

use frontend\assets\DashboardAsset;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;
use common\models\Order;
use yii\bootstrap\Modal;

DashboardAsset::register($this);

$this->title = Yii::t('common', 'Exchange');
$this->params['breadcrumbs'][] = $this->title;
$dropDownListDefult = [
    'prompt' => 'Все...'
];
$dropDownListOrdersType = [
    Order::TYPE_SELL => 'Продажа',
    Order::TYPE_BUY => 'Покупка'
];
?>
<div class="col-xs-12">
    <p>
    <h2> <?= Yii::t('common', 'Exchange') ?>  


    </h2>
</p>
</div>
<div  class="col-xs-12">
    <div class="exchange">

        <?php
        Modal::begin([
            'id' => 'modalOfferBuyForm',
            'header' => '<h2>Преобрести сертификат</h2>',
        ]);

        echo '<div class="contentOfferBuyForm"></div>';

        Modal::end();

        $form = ActiveForm::begin([
                    'id' => $model->formName(),
                    'method' => 'get'
        ]);
        ?>


        <div  class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading"><?= Yii::t('frontend', 'Search') ?></div>
                <div class="panel-body">


                    <div class="input-group input-group-sm ">
                        <div class="row">
                            <div class="col-xs-2">     
                                <?= $form->field($model, 'country_id')->dropDownList(common\models\Country::getCountryList(), $dropDownListDefult) ?>
                            </div> 
                            <div class="col-xs-2">   
                                <?= $form->field($model, 'club_id')->dropDownList(common\models\Club::getClubList(), $dropDownListDefult); ?> 

                            </div>        
                            <div class="col-xs-2">
                                <?= $form->field($model, 'apartment_type_id')->dropDownList(common\models\ApartmentType::getApartmentTypeList(), $dropDownListDefult); ?> 
                            </div>
                            <div class="col-xs-2">        
                                <?= $form->field($model, 'season_id')->dropDownList(common\models\Season::getSeasonList(), $dropDownListDefult); ?> 
                            </div>
                            <div class="col-xs-2">        
                                <?= $form->field($model, 'order_type')->dropDownList($dropDownListOrdersType, $dropDownListDefult); ?> 
                            </div>

                            <a role="button" data-toggle="collapse" href="#collapseSearch" aria-expanded="false" aria-controls="collapseSearch">
                                Расширеный поиск
                            </a>


                        </div>

                        <div class="collapse" id="collapseSearch">
                            <div class="col-xs-12"  style="margin-top: 10px;">
                                <div class="col-xs-2">   
                                    <?= $form->field($model, 'is_membership')->checkBox(['uncheck' => '0', 'value' => '1']) ?>

                                </div>
                                <div class="col-xs-2">    
                                    <?= $form->field($model, 'is_expertize')->checkBox(['uncheck' => '0', 'value' => '1']) ?>
                                </div>
                                <div class="col-xs-2"> 
                                    <?= $form->field($model, 'is_penalty')->checkBox(['uncheck' => '0', 'value' => '1']) ?>      
                                </div>
                                <div class="col-xs-2"> 
                                    <?= $form->field($model, 'is_priced')->checkBox(['uncheck' => '0', 'value' => '1']) ?>
                                </div>   
                            </div>
                            <div class="row"  style="margin-top: 10px;">
                                <div class="col-xs-3">       
                                    <?=
                                    $form->field($model, 'start_date')->widget(\dosamigos\datepicker\DatePicker::className(), [
                                        'template' => '{addon}{input}',
                                        'clientOptions' => [
                                            'autoclose' => true,
                                            'format' => 'yyyy-mm-dd'
                                        ]
                                    ])
                                    ?>   </div> 
                                <div class="col-xs-3">     
                                    <?=
                                    $form->field($model, 'end_date')->widget(\dosamigos\datepicker\DatePicker::className(), [
                                        'template' => '{addon}{input}',
                                        'clientOptions' => [
                                            'autoclose' => true,
                                            'format' => 'yyyy-mm-dd'
                                        ]
                                    ])
                                    ?> 
                                </div>
                                <div class="col-xs-3"> 
                                    <?=
                                    $form->field($model, 'certificate_period')->dropDownList(common\models\Certificate::$CERTIFICATE_PERIOD_ARRAY, $dropDownListDefult)
                                    ?>  
                                </div>  
                                <div class="col-xs-2"> <?= $form->field($model, 'bonus_weeks')->textInput() ?>  </div>    
                            </div>
                            <div class="col-xs-12" >  
                                <div class="col-xs-2" > 
                                    <?=
                                    $form->field($model, 'price_from')->textInput();
                                    ?>  
                                </div>   
                                <div class="col-xs-2" > 
                                    <?=
                                    $form->field($model, 'price_to')->textInput();
                                    ?>  
                                </div>   
                            </div>  

                        </div>

                    </div>
                    <p>

                    <div class="col-xs-2">
                        <?= Html::submitButton(Yii::t('frontend', 'Search'), ['class' => 'btn btn-info', 'name' => 'signup-button']) ?>
                    </div>
                    </p>
                </div>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>  



<div>
    <div class="col-xs-12">
        <div class="row">
            <p>
                <?php foreach ($orders as $order) { ?>      
                <div class="panel-group" id="accordion-<?= $order->id ?>  " role="tablist" aria-multiselectable="true">
                    <div class="panel 
                    <?php echo $order->type == Order::TYPE_SELL ? 'panel-success' : 'panel-info'; ?>

                         ">

                        <div class="panel-heading" role="tab" id="heading-ex-<?= $order->id ?>  ">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-ex-<?= $order->id ?>" aria-expanded="true" aria-controls="collapse-ex-<?= $order->id ?> ">

                                    <?= Yii::t('frontend', 'Pool') . ' №' . $order->id; ?>
                                </a>
                            </h4>
                        </div>
                        <div id="collapse-ex-<?= $order->id ?>" class="panel-collapse collapse  collapse-ex in" role="tabpanel" aria-labelledby="heading-<?= $order->id ?> ">
                            <div class="panel-body">
                                <div class="row">
                                    <?php if ($order->type == Order::TYPE_SELL) { ?>
                                        <div class="col-xs-4">

                                            <br>  <?= Yii::t('frontend', 'Code of certificate') . ': ' . $order->getCertificate()->certificate_code ?> </br>
                                            <br>  <?= Yii::t('frontend', 'Date of start') . ': ' . $order->getCertificate()->start_date ?> </br>
                                            <br>  <?= Yii::t('frontend', 'Date of end') . ': ' . $order->getCertificate()->end_date ?> </br>
                                            <br>  <?= Yii::t('frontend', 'Certificate period') . ': ' . $order->getCertificate()->certificate_period ?> </br>
                                            <br>  <?= Yii::t('frontend', 'Certificate costs') . ': ' . $order->getCertificate()->certificate_sum . ' ' . $order->getCertificate()->certificate_currency ?> </br>


                                        </div>
                                    <?php } ?>

                                    <div class="col-xs-4">
                                        <br>  <?= Yii::t('frontend', 'Country') . ': ' . $order->getCountry()->name ?> </br>
                                        <br>  <?= Yii::t('frontend', 'Club') . ': ' . $order->getClub()->name; ?> </br>
                                        <br>  <?= Yii::t('frontend', 'Apartment type') . ': ' . $order->getApartmentType()->name; ?> </br>
                                        <br>  <?= Yii::t('frontend', 'Season') . ': ' . $order->getSeason()->name; ?> </br>
                                        <br>  <?= Yii::t('frontend', 'Interval') . ': ' . $order->interval; ?> </br>

                                    </div>
                                    <div class="col-xs-12"> 
                                        <?php if ($order->type == Order::TYPE_SELL) { ?>
                                            <?= Html::submitButton(Yii::t('common', 'Купить'), ['value' => Url::to(['offers/offer-buy-form', 'id' =>  $order->id]), 'class' => 'btn btn-danger buttonOfferBuy', 'name' => 'buttonOfferBuy',]) ?>
                                        <?php } elseif ($order->type == Order::TYPE_BUY && $order->user_id != Yii::$app->user->identity->id) { ?>

                                            <?= Html::submitButton(Yii::t('common', 'Продать'), ['class' => 'btn btn-success', 'name' => 'signup-button']) ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            <?php } ?>

            <?=
            yii\widgets\LinkPager::widget([
                'pagination' => $pages,
            ]);
            ?>

            </p>
        </div>
    </div> </div>