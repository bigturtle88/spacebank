<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\LogMoneySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Log Moneys');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-money-index">

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
                'attribute' => 'user_id',
                'options' => ['width' => '50'],
                'label' => Yii::t('backend', 'User'),
                'format'=>'raw',
                'value'=>function ($data) {
                    return Html::a(common\models\User::findOne($data->user_id)->username, "?r=user%2Fview&id=".$data->user_id);
                },

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
                'content'=>function($data){
                return Yii::t('backend', $data->tip);
                }
            ],
            [
                'attribute' => 'status',
                'options' => ['width' => '150'],
                'label' => Yii::t('backend', 'Status'),
                'content'=>function($data){
                return Yii::t('backend', $data->status);
                }
            ],
            ['class' => 'yii\grid\ActionColumn','template'=>'{view} {update}  {delete}'],
        ],
    ]); ?>
</div>
