<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
?>
<div class="col-xs-12">
    <p>
    <h2> <?= Yii::t('frontend', 'Payments') ?>  


    </h2>
</p>
</div>
<?php
echo $this->render('/dashboard/dashboardTabs');
?>
<?=
GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
            [
            'attribute' => 'id',
            'options' => ['width' => '30'],
        ],
            [
            'attribute' => 'created_at',
            'format' => ['date', 'Y-MM-dd HH:mm'],
            'options' => ['width' => '150'],
            'label' => Yii::t('backend', 'Created at'),
        ],
            [
            'attribute' => 'sum',
            'options' => ['width' => '100'],
            'label' => Yii::t('backend', 'Sum'),
                
        ],
            [
            'attribute' => 'tip',
            'options' => ['width' => '150'],
            'label' => Yii::t('backend', 'Type'),
            'content' => function($data) {
          $statuses = common\models\Order::getStatuses();
                return Yii::t('frontend',$statuses[$data->tip]);
   
            }
        ],
            [
            'attribute' => 'status',
            'options' => ['width' => '150'],
            'label' => Yii::t('backend', 'Status'),
            'content' => function($data) {
                return Yii::t('backend', $data->status);
            }
        ],
    ],
]);
?>

<div>


</div>