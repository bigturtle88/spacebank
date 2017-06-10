<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TimeType */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => Yii::t('backend', 'Time setigns'),
]) . $model->block_number.'/'.$model->days;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Time setigns'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->block_number.'/'.$model->days, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="apartment-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
