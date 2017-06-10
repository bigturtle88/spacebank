<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Certificate */

$this->title = Yii::t('backend', 'Create Certificate');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Certificates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="certificate-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
