<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ApartmentType */

$this->title = Yii::t('backend', 'Create Apartment Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Apartment Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="apartment-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
