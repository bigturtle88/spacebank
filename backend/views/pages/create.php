<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PagesModel */

$this->title = Yii::t('backend', 'Create Page');
$this->params['breadcrumbs'][] = ['label' =>  Yii::t('backend', 'Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
        'url' => $url,
    ])
    ?>

</div>
