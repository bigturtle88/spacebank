<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Packages */

$this->title = Yii::t('common', 'Create Packages');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Packages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="packages-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
