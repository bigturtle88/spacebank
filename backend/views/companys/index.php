<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Companies');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('backend', 'Create Company'), ['create'], ['class' => 'btn btn-success']) ?>
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
                'attribute' => 'country',
                'label' => Yii::t('backend', 'Country')
            ],
            [
                'attribute' => 'info',
                'label' => Yii::t('backend', 'Info')
            ],
            [
                'attribute' => 'type',
                'label' => Yii::t('backend', 'Type')
            ],
            [
                'attribute' => 'is_active',
                'label' => Yii::t('backend', 'Active'),
                'format'=>'boolean'
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
