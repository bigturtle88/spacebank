<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PagesModelSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pages-model-search">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'content') ?>

        <?= $form->field($model, 'status') ?>

    <div class="form-group">
<?= Html::submitButton(Yii::t('backend', 'Search'), ['class' => 'btn btn-primary']) ?>
    <?= Html::resetButton(Yii::t('backend', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
