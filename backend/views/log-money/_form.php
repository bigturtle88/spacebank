<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\LogMoney */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="log-money-form">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'user_id',
                'label' => Yii::t('backend', 'User'),
                'format'=>'raw',
                'value'  => call_user_func(function ($data) {
                return Html::a(common\models\User::findOne($data->user_id)->username, "?r=user%2Fview&id=".$data->user_id);
                }, $model),
            ],
            [
                'attribute' => 'sum',
                'label' => Yii::t('backend', 'Sum'),
            ],
            [
                'attribute' => 'tip',
                'label' => Yii::t('backend', 'Type'),
                'value'  => call_user_func(function ($data) {
                return Yii::t('backend', $data->tip);
                }, $model),
                
            ],
            
            [
                'attribute' => 'created_at',
                'format' =>  ['date', 'Y-MM-dd HH:mm'],
                'label' => Yii::t('backend', 'Created at'),
            ],
        ],
    ]) ?>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status')->dropDownList([
                        '' => '',
                        'Executed' => Yii::t('backend', 'Executed'),
                        'Canceled' => Yii::t('backend', 'Canceled')
                    ])->label(Yii::t('backend', 'Status')) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
