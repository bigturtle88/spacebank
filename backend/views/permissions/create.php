<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\adminModel */

$this->title = Yii::t('backend', 'Create Admin');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Admin Models'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
