<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PagesModel */

$this->title = Yii::t('backend','Change Theme');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','Admin panel'), 'url' => ['site/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="theme-model-form">
    <?php $form = ActiveForm::begin(); ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th></th>
                <th><?=Yii::t('backend','Name Theme')?></th>
                <th><?=Yii::t('backend','Description')?></th>
                <th><?=Yii::t('backend','Pic')?></th>
            </tr>
        </thead>
        <?php foreach ($thems as $key => $value): ?>
            <div class="row">
                <tr>
                    <td class="col-md-1"><?= $form->field($model, 'value')->radio(['label' => '', 'value' => $key, 'uncheck' => null]) ?></td>
                    <td class="col-md-1"><?= $value->name ?></td>
                    <td class="col-md-1"><?= $value->description ?></td>
                    <td class="col-md-2"><img src="http://yiifar/1.jpg" class="img-thumbnail"></td>
                    <td class="col-md-1"><a href="#"><?= Yii::t('backend','Preview') ?></a></td>
                </tr>
            </div>
        <?php endforeach; ?>
    </table>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('backend','Save'), ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>