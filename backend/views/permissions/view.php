<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\adminModel */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Admin Models'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-model-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('backend', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'username',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            'email:email',
            'status:boolean',
            [
            'attribute' => 'permission',
            'label' => Yii::t('backend', 'Permission'),
                'value' => call_user_func(function($model) {
                 return is_null($model->getRoleName()) ? Yii::t('app','Not defined') : $model->getRoleName(); 
                }, $model),
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
