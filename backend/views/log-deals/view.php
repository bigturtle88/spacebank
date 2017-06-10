<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\LogDeals */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Log Deals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-deals-view">

    <h1>№ <?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'sum',
            [
                'attribute' => 'sum_system',
                'options' => ['width' => '50'],
                'label' => Yii::t('backend', 'Procent'),
            ],
            [
                'options' => ['width' => '50'],
                'label' => Yii::t('backend', 'Deal price'),
                'value'  => call_user_func(function ($data) {
                return $data->priced_value.' '.$data->priced_currency;
                }, $model),
            ],
            [
                'attribute' => 'seller_id',
                'label' => Yii::t('backend', 'Seller'),
                'format'=>'raw',
                'value'  => call_user_func(function ($data) {
                return Html::a(common\models\User::findOne($data->seller_id)->username, "?r=user%2Fview&id=".$data->seller_id);
                }, $model),
            ],
            [
                'attribute' => 'buyer_id',
                'label' => Yii::t('backend', 'Buyer'),
                'format'=>'raw',
                'value'  => call_user_func(function ($data) {
                return Html::a(common\models\User::findOne($data->buyer_id)->username, "?r=user%2Fview&id=".$data->buyer_id);
                }, $model),
            ],
            [
                'attribute' => 'packages_id',
                'options' => ['width' => '150'],
                'label' => Yii::t('backend', 'Package ID'),
            ],
            [
                'attribute' => 'created_at',
                'format' =>  ['date', 'Y-MM-dd HH:mm'],
                'label' => Yii::t('backend', 'Created at'),
            ],
        ],
    ]) ?>

</div>
