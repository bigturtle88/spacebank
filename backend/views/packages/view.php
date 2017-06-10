<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Packages */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Packages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="packages-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('backend', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('backend', 'Make package'), ['certificates', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
            [
                'attribute' => 'club_id',
                'format'=>'raw',
                'label' => Yii::t('backend','Club Name'),
                'value'  => call_user_func(function ($data) {
                return Html::a(common\models\Club::findOne($data->club_id)->name, "?r=clubs%2Fview&id=".$data->club_id);
                }, $model),
            ],
            [
                'attribute' => 'country_id',
                'format'=>'raw',
                'value'  => call_user_func(function ($data) {
                if($data->country_id){
                $arr=split(',',trim($data->country_id,','));
                $list='';
                foreach($arr as $a){
                    $list.=Html::a(common\models\Country::findOne($a)->name, "?r=countries%2Fview&id=".$a).'<br>';
                }
                return $list;
                }
                }, $model),
            ],
            [
                'attribute' => 'company',
                'format'=>'raw',
                'value'  => call_user_func(function ($data) {
                if($data->company){
                $arr=split(',',trim($data->company,','));
                $list='';
                foreach($arr as $a){
                    $list.=Html::a(common\models\Company::findOne($a)->name, "?r=companys%2Fview&id=".$a).'<br>';
                }
                return $list;
                }
                }, $model),
            ],
            [
                'attribute' => 'apartment_type_id',
                'format'=>'raw',
                'value'  => call_user_func(function ($data) {
                if($data->apartment_type_id){
                $arr=split(',',trim($data->apartment_type_id,','));
                $list='';
                foreach($arr as $a){
                    $list.=Html::a(common\models\ApartmentType::findOne($a)->name, "?r=apartments%2Fview&id=".$a).'<br>';
                }
                return $list;
                }
                }, $model),
            ],
            [
                'attribute' => 'certificate_period',
                'format'=>'raw',
                'value'  => call_user_func(function ($data) {
                if($data->certificate_period){
                $arr=split(',',trim($data->certificate_period,','));
                $list='';
                foreach($arr as $a){
                    $list.=$a.'<br>';
                }
                return $list;
                }
                }, $model),
            ],
            [
                'attribute' => 'season_id',
                'format'=>'raw',
                'value'  => call_user_func(function ($data) {
                if($data->season_id){
                $arr=split(',',trim($data->season_id,','));
                $list='';
                foreach($arr as $a){
                    $list.=Html::a(common\models\Season::findOne($a)->name, "?r=seasons%2Fview&id=".$a).'<br>';
                }
                return $list;
                }
                }, $model),
            ],
            'quantity',
            [
                'attribute' => 'quantity',
                'label' => Yii::t('common', 'List of certificates'),
                'format'=>'raw',
                'value'  => call_user_func(function ($data) {
                $arr=common\models\Certificate::getCertificatesPackageList($data->id);
                if($arr){
                $list='';
                foreach($arr as $a=>$v){
                    $list.=Html::a($v, "?r=certificates%2Fview&id=".$a).'<br>';
                }
                return $list;
                }
                }, $model),
            ],
            'priced_sum',
            'is_active:boolean',
            'is_blocked:boolean',
            [
                'attribute' => 'status',
                'label' => Yii::t('backend', 'Status'),
                'value'  => call_user_func(function ($data) {
                return Yii::t('common', $data->status);
                }, $model),
            ],
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
