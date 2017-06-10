<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Club;
use common\models\Country;
use common\models\User;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Certificates');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="certificate-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::a(Yii::t('backend', 'Create Certificate'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            ['attribute' => 'user_id',
                'label' => Yii::t('backend','FIO'),
                'value' => function($model) {
                    return User::findOne($model->user_id)->fio;  
                },
            ],
            //'club_id',
            ['attribute' => 'club_id',
                'label' => Yii::t('backend','Club Name'),
                'value' => function($model) {
                    return Club::findOne($model->club_id)->name;  
                },
            ],
            ['attribute' => 'country',
                'label' => Yii::t('backend','Country'),
                'value' => function($model) {
                    return Country::findOne($model->country_id)->name;  
                },
            ],
            //'country',
            [
                'attribute' => 'certificate_code',
                'label' => Yii::t('backend','Certificate Code')
            ],
            // 'start_date',
            // 'end_date',
            // 'contract_code',
            // 'contract_date',
            // 'certificate_period',
            // 'certificate_sum',
            // 'certificate_currency',
            // 'apartment_type_id',
            // 'season_id',
            // 'interval',
            // 'interval_numbers',
            // 'apartment_number',
            // 'bonus_weeks',
            // 'points',
            // 'fees_start_sum',
            // 'fees_start_currency',
            // 'fees_current_sum',
            // 'fees_current_currency',
            // 'is_penalty',
            // 'penalty_start_sum',
            // 'penalty_start_currency',
            // 'fees_loan_sum',
            // 'fees_loan_currency',
            // 'certificate_loan_sum',
            // 'certificate_loan_currency',
            // 'status',
            // 'is_expertize',
            // 'is_membership',
            // 'is_priced',
            // 'priced_sum',
            // 'priced_currency',
            // 'is_approved',
            // 'is_archive',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
