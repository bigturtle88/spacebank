<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\LogDealsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Log Deals');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-deals-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'id',
                'options' => ['width' => '30'],
            ],
            [
                'attribute' => 'created_at',
                'format' =>  ['date', 'Y-MM-dd HH:mm'],
                'options' => ['width' => '150'],
                'label' => Yii::t('backend', 'Created at'),
            ],
            [
                'attribute' => 'seller_id',
                'options' => ['width' => '50'],
                'label' => Yii::t('backend', 'Seller'),
                'format'=>'raw',
                'value'=>function ($data) {
                    return Html::a(common\models\User::findOne($data->seller_id)->username, "?r=user%2Fview&id=".$data->seller_id);
                },

            ],
            [
                'attribute' => 'buyer_id',
                'options' => ['width' => '50'],
                'label' => Yii::t('backend', 'Buyer'),
                'format'=>'raw',
                'value'=>function ($data) {
                    return Html::a(common\models\User::findOne($data->buyer_id)->username, "?r=user%2Fview&id=".$data->buyer_id);
                },

            ],
            [
                'attribute' => 'priced_value',
                'options' => ['width' => '120'],
                'label' => Yii::t('backend', 'Deal price'),
                'value'=>function ($data) {
                    return $data->priced_value.' '.$data->priced_currency;
                },

            ],          
            [
                'attribute' => 'packages_id',
                'options' => ['width' => '140'],
                'label' => Yii::t('backend', 'Package ID'),
            ],
            ['class' => 'yii\grid\ActionColumn','template'=>'{view}  {delete}'],
        ],
    ]); ?>
</div>
