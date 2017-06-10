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
        <?= Yii::t('common', 'Packages') ?>   
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
        'dataProvider' => $dataPackages,
        'columns' => [
            'id',
                [
                'attribute' => 'company',
                'content' => function ($data) {

                    $arr = explode(',', trim(trim($data->company), ","));
                    $list = '';
                    $arr = array_unique($arr);
                    foreach ($arr as $a) {

                        $company = common\models\Company::findOne($a);
                        $list .= $company['name'] . '<br>';
                    }


                    return $list;
                }
            ],
                [
                'label' => Yii::t('frontend', 'Club'),
                'attribute' => 'club_id',
                'content' => function ($data) {


                    $club = common\models\Club::findOne($data->club_id);



                    return $club->name;
                }
            ],
                [
                'attribute' => 'country_id',
                'content' => function ($data) {

                    $arr = explode(',', trim(trim($data->country_id), ","));
                    $list = '';
                    $arr = array_unique($arr);
                    foreach ($arr as $a) {

                        $country = common\models\Country::findOne($a);
                        $list .= $country['name'] . '<br>';
                    }


                    return $list;
                }
            ],
            'quantity',
            'priced_sum',
                ['class' => 'yii\grid\CheckboxColumn',
                'name' => 'packages',
                'checkboxOptions' => function ($model, $key, $index) {

                    if (Yii::$app->request->get()["id"] == $model->broker_id || $model->broker_id == null) {
                        return ['value' => trim($model->id), 'checked' => $model->broker_id];
                    } else {
                        return ['value' => trim($model->id), 'style' => 'display:none'];
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

