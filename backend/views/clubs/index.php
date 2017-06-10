<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Country;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Clubs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="club-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('backend', 'Create Club'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            
            'id',
            [
                'attribute' => 'name',
                'label' => Yii::t('backend', 'Name')
            ],
            ['attribute' => 'country',
                'label' => Yii::t('backend', 'Adres'),
            ],

            //'is_active:boolean',
            //'updated_at:datetime',
            [
                'attribute' => 'is_active',
                'label' => Yii::t('backend', 'Active'), 
                'format'=> 'boolean'
            ],
            

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
