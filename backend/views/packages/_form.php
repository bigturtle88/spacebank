<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \common\models\Club;
use common\models\CurrenciesQuery;

/* @var $this yii\web\View */
/* @var $model common\models\Packages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="packages-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'club_id')->dropDownList(array(''=>'') + Club::getClubList()) ?>


    <?= $form->field($model, 'is_active')->checkbox() ?>

    <?= $form->field($model, 'is_blocked')->checkbox() ?>

    <?= $form->field($model, 'status')->dropDownList([
                        '' => '',
                        'For sale' => Yii::t('common', 'For sale'),
                        'Blocked' => Yii::t('common', 'Blocked'),
                        'Sold' => Yii::t('common', 'Sold'),
                    ])->label(Yii::t('backend', 'Status')) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
