<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PagesModel */

$this->title = Yii::t('backend','Finance');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','Admin panel'), 'url' => ['site/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="theme-model-form">
    <?php $form = ActiveForm::begin(); ?>
    <table class="table table-striped">
        <?php foreach ($rows as $k => $v): ?>
            <div class="row">
                <tr>
                    <td class="col-md-1"><?= $v["description"] ?></td>
                    <td class="col-md-1"><input type="text" name="<?= $v["key"] ?>" value="<?= $v["value"] ?>"> </td>
                </tr>
            </div>
        <?php endforeach; ?>
    </table>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('backend','Save'), ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>