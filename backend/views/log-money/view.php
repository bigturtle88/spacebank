<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\LogMoney */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Log Moneys'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-money-view">

    <h1>№ <?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('backend', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
            [
                'attribute' => 'user_id',
                'label' => Yii::t('backend', 'User'),
                'format'=>'raw',
                'value'  => call_user_func(function ($data) {
                return Html::a(common\models\User::findOne($data->user_id)->username, "?r=user%2Fview&id=".$data->user_id);
                }, $model),
            ],
            [
                'attribute' => 'sum',
                'label' => Yii::t('backend', 'Sum'),
            ],
            [
                'attribute' => 'tip',
                'label' => Yii::t('backend', 'Type'),
                'value'  => call_user_func(function ($data) {
                return Yii::t('backend', $data->tip);
                }, $model),
                
            ],
            [
                'attribute' => 'status',
                'label' => Yii::t('backend', 'Status'),
                'value'  => call_user_func(function ($data) {
                return Yii::t('backend', $data->status);
                }, $model),
            ],
            [
                'attribute' => 'created_at',
                'format' =>  ['date', 'Y-MM-dd HH:mm'],
                'label' => Yii::t('backend', 'Created at'),
            ],
        ],
    ]) ?>

</div>
