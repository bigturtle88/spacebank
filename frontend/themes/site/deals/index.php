<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
?>
<div class="col-xs-12">
    <p>
    <h2> <?php echo Yii::t('backend', 'Deals History'); ?>


    </h2>
</p>
</div>
<?php
echo $this->render('/dashboard/dashboardTabs');
?>
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
                'options' => ['width' => '100'],
                'label' => Yii::t('backend', 'Created at'),
            ],
            [
                'attribute' => 'seller_id',
                'options' => ['width' => '50'],
                'label' => Yii::t('backend', 'Seller'),
                'format'=>'raw',
                'value'=>function ($data) {
                    return common\models\User::findOne($data->seller_id)->username;
                },

            ],
            [
                'attribute' => 'buyer_id',
                'options' => ['width' => '50'],
                'label' => Yii::t('backend', 'Buyer'),
                'format'=>'raw',
                'value'=>function ($data) {
                    return common\models\User::findOne($data->buyer_id)->username;
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
                'label' => Yii::t('frontend', 'Packages №'),
            ],
           
        ],
    ]); ?>

<div>


</div>