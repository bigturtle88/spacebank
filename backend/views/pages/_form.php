<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\components\ContrHelpers;
use dosamigos\ckeditor\CKEditor;
use backend\models\PagesModel;

/* @var $this yii\web\View */
/* @var $model app\models\PagesModel */
/* @var $form yii\widgets\ActiveForm */

//  
?>

<div class="pages-model-form">

<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?=
    $form->field($model, 'content')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
            //'preset' => 'basic'
    ])
    ?>

    <?= $form->field($url, 'slug')->textInput(['maxlength' => true])->label(Yii::t('backend','Slug')) ?>

    <?= $form->field($url, 'route')->dropDownList(ContrHelpers::Getcontrollersandactions())->label(Yii::t('backend','Route')) ?>

    <?= $form->field($model, 'status')->checkbox() ?>

    <?= $form->field($model, 'in_menu')->checkbox() ?>

    <?= $form->field($model, 'parent')->dropDownList($model->getList(), array('prompt' => 'Нет')) ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend','Create') : Yii::t('backend','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
