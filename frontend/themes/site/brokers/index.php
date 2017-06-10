<?php

use yii\helpers\Html;
use yii\bootstrap\Tabs;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
?>
<div class="col-xs-12">
    <p>
    <h2> <?= Yii::t('common', 'Broker') ?>  


    </h2>
</p>
</div>
<?php
echo $this->render('/dashboard/dashboardTabs');
?>

<?php
$form = ActiveForm::begin(['id' => $model->formName()]
);
?>
<?php
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
            [
            'attribute' => 'id',
            'label' => Yii::t('frontend', 'Id'),
        ],
            [
            'attribute' => 'username',
            'label' => Yii::t('frontend', 'Name'),
        ],
            [
            'attribute' => 'procent',
            'label' => Yii::t('backend', 'Procent'),
            'value' => function($data) {

                $procent = (new \yii\db\Query())
                        ->select(['procent'])
                        ->from('broker')
                        ->where(['broker_id' => $data['id']])
                        ->limit(1)
                        ->scalar();
                $procent = !isset($procent) ? 0 : $procent;
                return Html::textInput('procent[' . $data['id'] . ']', $procent, ['class' => 'form-control', 'style' => ['width' => '50px']]);
            },
            'format' => 'raw',
        ],
            ['class' => 'yii\grid\CheckboxColumn',
            'name' => 'broker_id', 'checkboxOptions' => ['onclick' => 'js:addItems(this.value, this.checked)'],
            'checkboxOptions' => function ($model, $key, $index, $column) {

                $is_active = (new \yii\db\Query())
                        ->select(['is_active'])
                        ->from('broker')
                        ->where(['broker_id' => $model->id])
                        ->limit(1)
                        ->scalar();
                if ($is_active == 1) {
                    return ['value' => trim($model->id), 'checked' => $is_active];
                }
                return ['value' => trim($model->id)];
            }
        ],
            ['class' => 'yii\grid\ActionColumn',
            'template' => '{broker-certificates} {broker-packages}',
            'buttons' => [
                'broker-certificates' => function ($url, $model, $id) {
                    $is_active = (new \yii\db\Query())
                            ->select(['is_active'])
                            ->from('broker')
                            ->where(['broker_id' => $model->id])
                            ->limit(1)
                            ->scalar();
                    if ($is_active == 1) {
                        return Html::a('<span class="glyphicon glyphicon-file"></span>', $url, ['title' => Yii::t('app', 'Certificate')]);
                    }
                },
                'broker-packages' => function ($url, $model, $id) {

                    $is_active = (new \yii\db\Query())
                            ->select(['is_active'])
                            ->from('broker')
                            ->where(['broker_id' => $model->id])
                            ->limit(1)
                            ->scalar();
                    if ($is_active == 1) {
                        return Html::a('<span class="glyphicon glyphicon-lock"></span>', $url, ['title' => Yii::t('app', 'Package')]);
                    }
                },
            ]],
    ],
]);
?>

<div class="form-group">
    <?= Html::submitButton(Yii::t('common', 'Save'), ['class' => 'btn btn-info', 'name' => 'packages-button']) ?>
</div>
<?php
ActiveForm::end();
?>
<div>


</div>