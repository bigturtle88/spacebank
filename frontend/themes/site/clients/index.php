<?php

use yii\helpers\Html;
use yii\bootstrap\Tabs;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
?>
<div class="col-xs-12">
    <p>
    <h2> <?= Yii::t('common', 'Clients') ?>  


    </h2>
</p>
</div>
<?php
echo $this->render('/dashboard/dashboardTabs');
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
            'attribute' => 'user_id',
            'label' => Yii::t('frontend', 'Username'),
            'value' => function($data) {
                if ($data->user_id != null) {
                    $user = common\models\User::findOne($data->user_id);
                }
                elseif ($data->consolidator_id != null) {
                    $user = common\models\User::findOne($data->consolidator_id);
                }
                return $user->username;
            },
        ],
            [
            'attribute' => 'type',
            'label' => Yii::t('backend', 'Type'),
            'value' => function($data) {
                if ($data->user_id != null) {
                    return Yii::t('common', 'User');
                }
                if ($data->consolidator_id != null) {
                    return Yii::t('common', 'Consolidator');
                }
            },
            'format' => 'raw',
        ],
            [
            'attribute' => 'procent',
            'label' => Yii::t('backend', 'Procent'),
            'value' => function($data) {

                return $data->procent;
            },
            'format' => 'raw',
        ],
    ],
]);
?>



<div>


</div>