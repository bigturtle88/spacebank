<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Countries');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="country-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('backend', 'Create Country'), ['create'], ['class' => 'btn btn-success']) ?>
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
                'attribute' => 'full_name',
                'label' => Yii::t('backend', 'Full Name')
            ],
            [
                'attribute' => 'iso_3166',
                'label' => Yii::t('backend', 'ISO Name')
            ],
            [
                'attribute' => 'is_active',
                'label' => Yii::t('backend', 'Active'),
                'format'=>'boolean'
            ],
            

            //'name',
            //'full_name:ntext',
            //'iso_3166:ntext',
            //'is_active:boolean',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
