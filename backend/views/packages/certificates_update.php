<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use common\models\Certificate;

/* @var $this yii\web\View */
/* @var $model common\models\Packages */

$this->title = Yii::t('backend', 'Make package') . ': '.$model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Packages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Make package');
?>
<div class="packages-update">

    <h1><?= Html::encode($this->title) ?></h1>


<div class="packages-update">

    <?php
    $form = ActiveForm::begin(['id' => $model->formName()]);
    ?>
    <?php
    echo GridView::widget([
        'dataProvider' => $dataCertificate,
        'columns' => [
                [
                'attribute' => 'certificate_code',
                'label' => Yii::t('frontend', 'Code of certificate'),
            ],
                [
                'format' => 'text',
                'attribute' => 'club_id',
                'label' => Yii::t('frontend', 'Club'),
                'value' => function ($data) {

                    $club = common\models\Club::findOne($data->club_id);
                    return $club->name;
                },
                'filter' => Certificate::getClubUser()
            ],
                [
                'attribute' => 'country_id',
                'label' => Yii::t('frontend', 'Country'),
                'value' => function ($data) {

                    $country = common\models\Country::findOne($data->country_id);
                    return $country->name;
                }
            ],
                ['label' => Yii::t('frontend', 'Certificate costs'),
                'attribute' => 'certificate_sum',],
                [
                'label' => Yii::t('frontend', 'Currency'),
                'attribute' => 'certificate_currency',
            ], 
                  [
                'label' => Yii::t('frontend', 'Packages №'),
                'attribute' => 'package_id',
            ],   
                     
                ['class' => 'yii\grid\CheckboxColumn',
                'name' => 'certificates', 'checkboxOptions' => ['onclick' => 'js:addItems(this.value, this.checked)'],
                'checkboxOptions' => function ($model, $key, $index, $column) {
                    return ['value' => trim($model->certificate_code), 'checked' => $model->package_id];
                }
            ],
        ],
    ]);
    ?>

</div>
<div class="form-group">
    <?= Html::submitButton(Yii::t('common', 'Save'), ['class' => 'btn btn-info', 'name' => 'packages-button']) ?>
</div>
</div>

<?php ActiveForm::end(); ?> 

</div>
