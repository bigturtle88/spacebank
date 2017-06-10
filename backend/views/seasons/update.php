<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Season */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => Yii::t('backend','Season'),
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Seasons'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="season-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
