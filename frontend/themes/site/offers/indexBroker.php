<?php

use yii\helpers\Html;
use yii\bootstrap\Tabs;
use yii\helpers\Url;
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
                case \common\models\Offer::STATUS_PENDING : return ['class' => 'success'];
                default : return ['class' => 'default'];
            }
        }
    },
    'columns' => [
            ['attribute' => 'id', 'label' => Yii::t('frontend', 'Pull №')],
            ['attribute' => 'seller_id', 'label' => Yii::t('frontend', 'Seller'),
            'content' => function($data) {

                $user = common\models\User::findOne($data->seller_id);
                if (!$user) {
                    return 'error';
                }
                return $user->fio;
            }
        ],
            ['attribute' => 'buyer_id', 'label' => Yii::t('frontend', 'Buyer'), 'content' => function($data) {
                $user = common\models\User::findOne($data->buyer_id);
                if (!$user) {
                    return 'error';
                }
                return $user->fio;
            }],
            ['attribute' => 'status', 'label' => Yii::t('frontend', 'Status'), 'label' => Yii::t('frontend', 'Status'), 'content' => function($data) {
                $status = common\models\Offer::getStatus($data->status);


                return Yii::t('frontend', $status);
            }],
            ['attribute' => 'quantity', 'label' => Yii::t('frontend', 'Quantity of certificate'), 'label' => Yii::t('frontend', 'Quantity of certificate'), 'content' => function($data) {
                $package = common\models\Packages::findOne(common\models\Order::findOne($data->source_id)->source_id);


                return $package->quantity;
            }],
            ['attribute' => 'bid', 'label' => Yii::t('frontend', 'Bid'),
            'content' => function($data) {
                $order = common\models\Order::findOne($data->source_id);
                !$order ? $order = ' ' : $order = $order;
                return $data->bid . ' ' . $order->priced_currency;
            }],
            ['attribute' => 'created_at', 'label' => Yii::t('frontend', 'Сreated at'),
            'content' => function($data) {

                return date('d-m-Y', $data->created_at);
            }],
            ['class' => 'yii\grid\ActionColumn',
            'template' => '{ok} {pending} {reject} {timeout} {cancel} {new} {trade}',
            'buttons' => [
                'reject' => function ($url, $model, $id) {
                    if ($model->author_id != Yii::$app->user->identity->id && $model->user_id == Yii::$app->user->identity->id && $model->status != \common\models\Offer::STATUS_CANCEL && $model->status != \common\models\Offer::STATUS_OK && $model->status != \common\models\Offer::STATUS_PENDING)
                        return Html::a(' <button type="button" class="btn btn-danger dropdown-toggle"  aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-remove"></span></button>', $url, ['title' => Yii::t('app', 'Reject')]);
                },
                'ok' => function ($url, $model, $id) {
                    if (($model->seller_id == $model->user_id || $model->buyer_id == $model->user_id || ($model->status == \common\models\Offer::STATUS_PENDING && $model->user_id == Yii::$app->user->identity->id )) && $model->author_id != Yii::$app->user->identity->id && $model->user_id = Yii::$app->user->identity->id && $model->status != \common\models\Offer::STATUS_CANCEL && $model->status != \common\models\Offer::STATUS_OK)
                        return Html::a(' <button type="button" class="btn btn-success dropdown-toggle"  aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon glyphicon-ok"></span></button>', $url, ['title' => Yii::t('app', 'Ok')]);
                },
                'pending' => function ($url, $model, $id) {
                    if (($model->seller_id != $model->user_id || $model->buyer_id != $model->user_id) && $model->author_id != Yii::$app->user->identity->id && $model->user_id != Yii::$app->user->identity->id && $model->status != \common\models\Offer::STATUS_CANCEL && $model->status != \common\models\Offer::STATUS_PENDING && $model->status != \common\models\Offer::STATUS_OK)
                        return Html::a(' <button type="button" class="btn btn-success dropdown-toggle"  aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon glyphicon-ok"></span></button>', $url, ['title' => Yii::t('app', 'Ok')]);
                },
                'timeout' => function ($url, $model, $id) {
                    if ($model->author_id != Yii::$app->user->identity->id && $model->user_id == Yii::$app->user->identity->id && $model->status != \common\models\Offer::STATUS_CANCEL && $model->status != \common\models\Offer::STATUS_OK && $model->status != \common\models\Offer::STATUS_PENDING)
                        return Html::a(' <button type="button" class="btn btn-warning dropdown-toggle"  aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon glyphicon-time"></span></button>', $url, ['title' => Yii::t('app', 'Time Out')]);
                },
                'cancel' => function ($url, $model, $id) {
                    if ($model->author_id == Yii::$app->user->identity->id && $model->status != \common\models\Offer::STATUS_CANCEL && $model->status != \common\models\Offer::STATUS_OK && $model->status != \common\models\Offer::STATUS_PENDING)
                        return Html::a(' <button type="button" class="btn btn-warning dropdown-toggle"  aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-off"></span></button>', $url, ['title' => Yii::t('app', 'Cancel')]);
                },
                'new' => function ($url, $model, $id) {
                    if ($model->author_id == Yii::$app->user->identity->id && $model->status == \common\models\Offer::STATUS_CANCEL && $model->status != \common\models\Offer::STATUS_OK && $model->status != \common\models\Offer::STATUS_PENDING)
                        return Html::a(' <button type="button" class="btn btn-info dropdown-toggle"  aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-refresh"></span></button>', $url, ['title' => Yii::t('app', 'New')]);
                },
                'trade' => function ($url, $model, $id) {
                    if ($model->status != \common\models\Offer::STATUS_CANCEL && $model->status != \common\models\Offer::STATUS_OK && $model->status != \common\models\Offer::STATUS_PENDING)
                        return Html::submitButton(Yii::t('common', 'Торговля'), ['value' => $url, 'class' => 'btn btn-info showModalButton', 'title' => 'Торговля', 'name' => 'buttonOfferTrade']);

//Html::submitButton('<button type="button" class="btn btn-info  showModalButton" ><span>Торговля</span></button>', '', ['title' => Yii::t('app', 'Trade'), 'value' => Url::to($url)]);
                }
            ], 'urlCreator' => function ($action, $model, $key, $index, $status) {

                $status = common\models\Offer::getStatuses();

                switch ($action) {
                    case $status[\common\models\Offer::STATUS_REJECT] : $url = Yii::$app->urlManager->createUrl(['/offers/offer-status-update', 'id' => $key, 'status' => \common\models\Offer::STATUS_REJECT]);
                        break;
                    case $status[\common\models\Offer::STATUS_OK] : $url = Yii::$app->urlManager->createUrl(['/offers/offer-transaction', 'id' => $key]);
                        break;
                    case $status[\common\models\Offer::STATUS_TIMEOUT] : $url = Yii::$app->urlManager->createUrl(['/offers/offer-status-update', 'id' => $key, 'status' => \common\models\Offer::STATUS_TIMEOUT]);
                        break;
                    case $status[\common\models\Offer::STATUS_CANCEL] : $url = Yii::$app->urlManager->createUrl(['/offers/offer-status-update', 'id' => $key, 'status' => \common\models\Offer::STATUS_CANCEL]);
                        break;
                    case $status[\common\models\Offer::STATUS_NEW] : $url = Yii::$app->urlManager->createUrl(['/offers/offer-status-update', 'id' => $key, 'status' => \common\models\Offer::STATUS_NEW]);
                        break;
                    case $status[\common\models\Offer::STATUS_PENDING] : $url = Yii::$app->urlManager->createUrl(['/offers/offer-pending', 'id' => $key, 'status' => \common\models\Offer::STATUS_OK]);
                        break;
                    case 'trade' : $url = Yii::$app->urlManager->createUrl(['/offers/offer-trade', 'id' => $key]);
                        break;
                }
                return $url;
            }
        ],
    ],
]);
?>
 