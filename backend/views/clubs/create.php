<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Club */

$this->title = Yii::t('backend', 'Create Club');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Clubs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="club-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
