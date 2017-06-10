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
?>
<div class="col-xs-12">
    <p>
    <h2> <?= Yii::t('common', 'Exchange') ?>  


    </h2>
</p>
</div>
<div  class="col-xs-12">
    <div class="exchange">
        <?php echo $this->render('exchangeSearch', ['model' => $model]); ?>
    </div>
</div>  




<div class="col-xs-12">
    <div class="row">

        <?php foreach ($orders as $order) { ?>      
            <div class="panel-group  col-xs-6"  >
                <div class="panel 
                <?php echo $order->type == Order::TYPE_SELL ? 'panel-success' : 'panel-info'; ?>

                     ">

                    <div class="panel-heading" >
                        <h4 class="panel-title">
                            <a role="button" >

                                <?= Yii::t('frontend', 'Pool') . ' №' . $order->id ?>

                                <?php if ($order->type == Order::TYPE_SELL) { ?>
                                    <?= Yii::t('frontend', 'Sell offer') ?>
                                <?php } elseif ($order->type == Order::TYPE_BUY) { ?>

                                    <?= Yii::t('frontend', 'Buy offer') ?>
                                <?php } ?>

                                <?php if ($order->user_id != $order->author_id) { ?>
                                    <?= '(' . Yii::t('frontend', 'Broker') . ')' ?>

                                <?php } ?>
                            </a>
                        </h4>
                    </div>
                    <div id="collapse-ex-<?= $order->id ?>" class=" collapse-ex in" role="tabpanel" aria-labelledby="heading-<?= $order->id ?> ">
                        <div class="panel-body">
                            <div class="row">
                                <div class="clearfix"></div>
                                <div class="col-xs-12">    <div class="row"> <ul> <div class="clearfix"> 
                                                <div class="row">  <div class="col-xs-5">
                                                        <div class="row"> 
                                                            <br>  <?= Yii::t('frontend', 'Code of packages') . ': ' . $order->source_id ?> </br>
                                                            <br>  <?= Yii::t('frontend', 'Country') . ': ' . substr(Order::getCountryString($order->country_id), 0, 10) . '...' ?> </br>
                                                            <br>  <?= Yii::t('frontend', 'Apartment type') . ': ' . substr(Order::getApartmentTypeString($order->apartment_type_id), 0, 10) . '...' ?> </br>
                                                            <br> <?php if ($order->type == Order::TYPE_SELL) { ?>   
                                                                <?= Yii::t('frontend', 'Quantity of certificate') . ': ' . $order->getQuantityCertificate()->quantity ?> 
                                                            <?php } ?> 
                                                            </br>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-5">     <div class="row"> 
                                                            <br>  <?= Yii::t('frontend', 'Club') . ': ' . substr($order->getClub()->name, 0, 20) . '...' ?> </br>
                                                            <br>  <?= Yii::t('frontend', 'Price') . ': ' . $order->priced_value . '  ' . $order->priced_currency; ?> </br>
                                                            <br>  <?= Yii::t('frontend', 'Season') . ': ' . substr(Order::getSeasonString($order->season_id), 0, 20) . '...' ?> </br>
                                                        </div></div></div>
                                            </div>
                                        </ul>    </div>  


                                </div> 

                                <div class="col-xs-12"> 
                                    <p class="text-right">
                                        <?php if ($order->type == Order::TYPE_SELL && $order->user_id != Yii::$app->user->identity->id) { ?>
                                            <?= Html::submitButton(Yii::t('frontend', 'Create Buy Offer'), ['value' => Url::to(['offers/offer-buy-form', 'id' => $order->id]), 'title' => Yii::t('frontend', 'Create Buy Offer'), 'class' => 'btn btn-danger buttonOfferBuy  showModalButton', 'name' => 'buttonOfferBuy',]) ?>
                                        <?php } elseif ($order->type == Order::TYPE_BUY && $order->user_id != Yii::$app->user->identity->id) { ?>

                                            <?= Html::submitButton(Yii::t('frontend', 'Create Sell Offer'), ['value' => Url::to(['offers/offer-sell-form', 'id' => $order->id]), 'class' => 'btn btn-success  buttonOfferSell showModalButton', 'title' => Yii::t('frontend', 'Create Sell Offer'), 'name' => 'buttonOfferSell']) ?>
                                        <?php } ?>
                                    </p> </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        <?php } ?>




    </div>
</div>   </div>
<?=
yii\widgets\LinkPager::widget([
    'pagination' => $pages,
]);
?>