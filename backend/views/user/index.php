<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend','Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('backend','Create User'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'id',
                'options' => ['width' => '30'],
            ],
            [
                'attribute' => 'username',
                'label' => Yii::t('backend', 'User name')
            ],
            [
                'attribute' => 'email',
                'label' => Yii::t('backend', 'Email'), 
                'format'=>'email'
            ],
            
            [
                'attribute' => 'user_type',
                'label' => Yii::t('backend', 'Status'),
                'value' => function($model) {
                    if(!$model->user_type)$model->user_type='User';
                    return Yii::t('common',$model->user_type);
                }, 
            ],
            /*[
                'attribute' => 'user_type',
                'label' => Yii::t('backend', 'User type'),
                'format' => 'boolean' 
            ],
            [
                'attribute' => 'tel',
                'label' => Yii::t('backend', 'Phone number'), 
            ],
             */
            [
                'attribute' => 'fio',
                'label' => Yii::t('backend', 'FIO'), 
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
</div>
