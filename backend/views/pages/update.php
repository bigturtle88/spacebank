<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PagesModel */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => Yii::t('backend','Page'),
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="pages-model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
        'url' => $url,
    ])
    ?>

</div>
