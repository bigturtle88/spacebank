<?php

use Yii;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use common\models\Certificate;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model common\models\Offer */
?>


<div class="col-xs-12">
    <p>
    <h2>
        <?= Yii::t('common', 'Certificates') ?>   
    </h2>
</p>
</div>

<?php echo $this->render('/dashboard/dashboardTabs'); ?>
<div class="packages-update">
    <?php
    $form = ActiveForm::begin(['id' => $model->formName()]
    );
    ?>
    <?php
    Pjax::begin();
    echo GridView::widget([
        'dataProvider' => $dataCertificate,
        // 'filterModel' => $searchModel,
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
                ['class' => 'yii\grid\CheckboxColumn',
                'name' => 'certificates',
                'checkboxOptions' => function ($model, $key, $index) {

                    if (Yii::$app->request->get()["id"] == $model->broker_id || $model->broker_id == null) {
                        return ['value' => trim($model->certificate_code), 'checked' => $model->broker_id];
                    } else {
                        return ['value' => trim($model->certificate_code), 'style' => 'display:none'];
                    }
                }
            ],
        ],
    ]);
    ?>



</div>
</div>
<div class="form-group">
    <?= Html::submitButton(Yii::t('common', 'Save'), ['class' => 'btn btn-info', 'name' => 'packages-button']) ?>
</div>


</div>

</div>
<?php Pjax::end(); ?>
<?php ActiveForm::end(); ?> 

</div>

</div>

