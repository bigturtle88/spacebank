<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Seasons');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="season-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('backend', 'Create Season'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            [
                'attribute' => 'name',
                'label' => Yii::t('backend', 'Name')
            ],
            [
                'attribute' => 'description',
                'label' => Yii::t('backend', 'Description'), 
                'format'=> 'ntext'
            ],
            [
                'attribute' => 'is_active',
                'label' => Yii::t('backend', 'Active'), 
                'format'=> 'boolean'
            ],
            
            //'name',
            //'description:ntext',
            //'is_active:boolean',
            //'created_at:datetime',
            //'updated_at:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
