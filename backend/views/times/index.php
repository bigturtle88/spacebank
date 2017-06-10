<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Time setigns');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="apartment-type-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('backend', 'Create').' '.Yii::t('backend', 'Time setigns'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',

            [
                'attribute' => 'block_number',
                'label' => Yii::t('common', 'Number of certificates')
            ],
            [
                'attribute' => 'days',
                'label' => Yii::t('backend', 'Number of days')
            ],
            [
                'attribute' => 'penalty_seller',
                'label' => Yii::t('backend', 'Penalty to seller')
            ],
            [
                'attribute' => 'penalty_buyer',
                'label' => Yii::t('backend', 'Penalty to buyer')
            ],
            //'block_number',
            //'days',
            //'penalty_seller',
            //'penalty_buyer',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
