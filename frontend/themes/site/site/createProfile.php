<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;

$script = <<< JS
    function isFirm(date){
        if(date.checked === true){
            $('.is_firm').show();
        }else{
            $('.is_firm').hide();
        }
    };
JS;

$this->registerCss(".is_firm {display:none;}");
$this->registerJs($script, yii\web\View::POS_BEGIN);
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <div class="col-lg-5">
<?php
$form = ActiveForm::begin([
            'id' => $model->formName(),
            'enableAjaxValidation' => true,
            'validationUrl' => Url::toRoute('validation-profile-form'),
        ]);
?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'email') ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'password_repeat')->passwordInput() ?>

            <?= $form->field($model, 'fio')->textInput() ?>

            <?= $form->field($model, 'tel')->textInput() ?>

            <?= $form->field($model, 'is_individual')->checkBox(['class' => 'isFirm', 'onchange' => 'isFirm(this);']) ?>
            <div class="is_firm">
            <?= $form->field($model, 'contact')->textInput() ?>

                <?= $form->field($model, 'firm_name')->textInput() ?>                
            </div>
            <div class="form-group">
                <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>

                <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
