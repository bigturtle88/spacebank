<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AdminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Admins');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-model-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('backend', 'Create Admin'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'username',
            'email:email',
            'status:boolean',
            [
            'attribute' => 'permission',
                'label' => Yii::t('backend', 'Permission'),
                'value' => function($model) {
                 return is_null($model->getRoleName()) ? Yii::t('backend','Not defined') : $model->getRoleName(); 
                },
            ],

            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
