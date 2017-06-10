<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ApartmentType */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Apartment Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="apartment-type-view">

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
            'name',
            'description:ntext',
            'is_active:boolean',
            [
                'attribute' => 'created_at',
                'format' =>  ['date', 'Y-MM-dd HH:mm'],
                'label' => Yii::t('backend', 'Created at'),
            ],
            [
                'attribute' => 'updated_at',
                'format' =>  ['date', 'Y-MM-dd HH:mm'],
                'label' => Yii::t('backend', 'Updated at'),
            ],
        ],
    ]) ?>

</div>
