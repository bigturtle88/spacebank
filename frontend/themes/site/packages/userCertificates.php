<?php

use common\models\Certificate;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;
use yii\helpers\Url;
use yii\widgets\Pjax;
use common\models\User;
?>

<?php
$form = ActiveForm::begin(['id' => $model->formName()]
);
?>
<?php
Pjax::begin();
echo GridView::widget([
    'dataProvider' => $dataCertificate,
    'filterModel' => $searchModel,
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
        ], ['label' => Yii::t('frontend', 'Broker'),
            'attribute' => 'broker_id',
            'content' => function ($model) {
                
                if ($model->broker_id != null) {
                    $broker = User::findOne($model->broker_id);
                    $username = !is_null($broker) ? $broker->username : '-';
                } else
                    $username = '-';

                return $username;
            }
        ],
            ['class' => 'yii\grid\CheckboxColumn',
            'name' => 'certificates',
            'checkboxOptions' => function ($model, $key, $index) {

                if ($model->broker_id == null) {
                    return ['value' => trim($model->certificate_code)];
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



</div>
<div class="form-group">
    <?= Html::submitButton(Yii::t('common', 'Save'), ['class' => 'btn btn-info', 'name' => 'packages-button']) ?>
</div>
</div>
<?php Pjax::end(); ?>
<?php ActiveForm::end(); ?> 
