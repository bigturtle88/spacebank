<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CountriesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="clubs-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div  class="col-xs-12">
    <div class="panel panel-default">
        <div class="panel-heading"><?= Yii::t('backend', 'Search') ?></div>
        <div class="panel-body">


            <div class="input-group input-group-sm ">
                <div class="row">
                    <div class="col-xs-3">
                        <?= $form->field($model, 'name')->label(Yii::t('backend', 'Name')) ?>
                    </div>
                    <div class="col-xs-3">
                        <?= $form->field($model, 'country')->label(Yii::t('backend', 'Country')) ?>
                    </div>
                    <div class="col-xs-2" style="margin-top:24px;">
                        <?= $form->field($model, 'is_active')->checkbox(['label' => Yii::t('backend', 'Active')]) ?>
                    </div>
                    <div class="col-xs-4" style="margin-top:24px;">
                        <?= Html::submitButton(Yii::t('backend', 'Search'), ['class' => 'btn btn-primary']) ?>
                        <?= Html::resetButton(Yii::t('backend', 'Reset'), ['class' => 'btn btn-default']) ?>
                    </div>  
                    
                </div>
            </div>
         </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
</div>
