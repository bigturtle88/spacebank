<?php

use common\models\Certificate;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;
use kartik\builder\TabularForm;
use yii\helpers\Url;
use yii\widgets\Pjax;
?>

<?php
$form = kartik\form\ActiveForm::begin(
                ['id' => $model->formName()]
);
?>
<?php Pjax::begin(); ?>
<?php
echo TabularForm::widget([
    'dataProvider' => $dataCertificate,
    'form' => $form,
    'staticOnly' => true,
    'actionColumn' => false,
    'attributes' => [
        'certificate_code' => ['label' => 'certificate_code', 'type' => TabularForm::INPUT_HIDDEN_STATIC]
    ],
]);
?>
<?php Pjax::end(); ?>


</div>
</div>


<div class="form-group">
    <?= Html::submitButton(Yii::t('common', 'Save'), ['class' => 'btn btn-info', 'name' => 'packages-button']) ?>
</div> 
</div>

</div>

<?php kartik\form\ActiveForm::end(); ?>
 