<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Time */

$this->title = Yii::t('backend', 'Create').' '.Yii::t('backend', 'Time setigns');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Time setigns'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="apartment-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
