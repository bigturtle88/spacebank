<?php

use yii\helpers\Html;
use yii\bootstrap\Tabs;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
?>


<?=
\yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'rowOptions' => function ($model, $statusOffers) {
        if (common\models\Offer::getStatus($model->status) != null) {
            switch ($model->status) {
                case \common\models\Offer::STATUS_NEW : return ['class' => 'info'];
                case \common\models\Offer::STATUS_REJECT : return ['class' => 'danger'];
                case \common\models\Offer::STATUS_OK : return ['class' => 'success'];
                case \common\models\Offer::STATUS_TIMEOUT : return ['class' => 'warning'];
                default : return ['class' => 'default'];
            }
        }
    },
    'columns' => [
            ['attribute' => 'id', 'label' => '№'],
            ['attribute' => 'seller_id', 'label' => Yii::t('frontend', 'Seller'),
            'content' => function($data) {
                return common\models\User::findOne($data->seller_id)->fio;
            }
        ],
            ['attribute' => 'buyer_id', 'label' => Yii::t('frontend', 'Buyer'), 'content' => function($data) {
                return common\models\User::findOne($data->buyer_id)->fio;
            }],
            ['attribute' => 'status', 'label' => Yii::t('frontend', 'Status'), 'label' => Yii::t('frontend', 'Status'), 'content' => function($data) {
                $status = common\models\Offer::getStatus($data->status);
                return Yii::t('frontend', $status);
            }],
            ['attribute' => 'bid', 'label' => Yii::t('frontend', 'Bid'),
            'content' => function($data) {
                $order = common\models\Order::findOne($data->source_id);
                !$order ? $order = ' ' : $order = $order;
                return $data->bid . ' ' . $order->priced_currency;
            }],
            ['attribute' => 'description', 'label' => Yii::t('frontend', 'Description')],
            ['class' => 'yii\grid\ActionColumn',
            'template' => '{ok} {reject} {timeout} {cancel} {new} {trade}',
        ],
    ],
]);
?>

<div>


</div>
<?php
$dropDownListDefult = [
    'prompt' => 'Выбрать...'
];
?>

<div>

    <?php  if ($model->getOffer()->buyer_id == Yii::$app->user->identity->id || $model->getOffer()->seller_id == Yii::$app->user->identity->id) { ?>
      <?php  $form = ActiveForm::begin([
        'id' => $model->formName(),
        'enableAjaxValidation' => true,
        'validationUrl' => Url::toRoute('validation-offer-trade-form'),
        'action' => Url::toRoute(['offers/offer-trade', 'id' => $model->offer_id]),
        ]);
        ?>
        <div class="panel panel-default">
            <div class="panel-heading"><?= Yii::t('frontend', 'Parameter buy') ?></div>
            <div class="panel-body">

                <div class="input-group input-group-sm row">
                    <div class="col-xs-12">       
                        <div class="row">
                            <div class="col-xs-4">     
                                <?= $form->field($model, 'bid')->textInput(); ?>
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
        <?php ActiveForm::end(); ?> <?php } ?>

</div>