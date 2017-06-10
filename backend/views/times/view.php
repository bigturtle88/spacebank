<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TimeType */

$this->title = $model->block_number.'/'.$model->days;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Time setigns'), 'url' => ['index']];
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
            'block_number',
            'days',
            'penalty_seller',
            'penalty_buyer',
        ],
    ]) ?>

</div>
