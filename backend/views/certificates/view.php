<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Certificate */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Certificates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="certificate-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('backend', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'user_id',
                'label' => Yii::t('backend', 'User'),
                'format'=>'raw',
                'value'  => call_user_func(function ($data) {
                return Html::a(common\models\User::findOne($data->user_id)->username, "?r=user%2Fview&id=".$data->user_id);
                }, $model),
            ],
            
            'certificate_code',
            'start_date',
            'end_date',
            'certificate_period',
            'contract_code',
            'contract_date',
            'certificate_sum',
            'certificate_currency',
            [
                'attribute' => 'country_id',
                'format'=>'raw',
                'value'  => call_user_func(function ($data) {
                return Html::a(common\models\Country::findOne($data->country_id)->name, "?r=countries%2Fview&id=".$data->country_id);
                }, $model),
            ],
            [
                'attribute' => 'club_id',
                'format'=>'raw',
                'value'  => call_user_func(function ($data) {
                return Html::a(common\models\Club::findOne($data->club_id)->name, "?r=clubs%2Fview&id=".$data->club_id);
                }, $model),
            ],
            [
                'attribute' => 'apartment_type_id',
                'format'=>'raw',
                'value'  => call_user_func(function ($data) {
                return Html::a(common\models\ApartmentType::findOne($data->apartment_type_id)->name, "?r=apartments%2Fview&id=".$data->apartment_type_id);
                }, $model),
            ],
            [
                'attribute' => 'season_id',
                'format'=>'raw',
                'value'  => call_user_func(function ($data) {
                return Html::a(common\models\Season::findOne($data->season_id)->name, "?r=seasons%2Fview&id=".$data->season_id);
                }, $model),
            ],
            [
                'attribute' => 'company_id',
                'format'=>'raw',
                'value'  => call_user_func(function ($data) {
                return Html::a(common\models\Company::findOne($data->company_id)->name, "?r=companys%2Fview&id=".$data->company_id);
                }, $model),
            ],
            'interval',
            'interval_numbers',
            'apartment_number',
            'bonus_weeks',
            'points',
            'fees_start_sum',
            'fees_start_currency',
            'fees_current_sum',
            'fees_current_currency',
            'is_penalty:boolean',
            'penalty_start_sum',
            'penalty_start_currency',
            'fees_loan_sum',
            'fees_loan_currency',
            'certificate_loan_sum',
            'certificate_loan_currency',
            'is_membership:boolean',
            'is_expertize:boolean',
            'is_priced:boolean',
            'priced_sum',
            'priced_currency',
            'is_approved:boolean',
            'is_archive:boolean',
            [
                'attribute' => 'created_at',
                'format' =>  ['date', 'Y-MM-dd HH:mm'],
                'label' => Yii::t('backend', 'Created at'),
            ],
            [
                'attribute' => 'updated_at',
                'format' =>  ['date', 'Y-MM-dd HH:mm'],
                'label' => Yii::t('backend', 'Updated at'),
            ],
        ],
    ]) ?>

</div>
