<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PackagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('common', 'Packages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="packages-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('common', 'Create Packages'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'id',
                'options' => ['width' => '30'],
            ],
            [
                'attribute' => 'created_at',
                'format' =>  ['date', 'Y-MM-dd HH:mm'],
                'options' => ['width' => '150'],
                'label' => Yii::t('backend', 'Created at'),
            ],
            [
                'attribute' => 'user_id',
                'options' => ['width' => '50'],
                'label' => Yii::t('backend', 'User'),
                'format'=>'raw',
                'value'=>function ($data) {
                    return Html::a(common\models\User::findOne($data->user_id)->username, "?r=user%2Fview&id=".$data->user_id);
                },

            ],
            [
                'attribute' => 'club_id',
                'format'=>'raw',
                'value'=>function ($data) {
                    return Html::a(common\models\Club::findOne($data->club_id)->name, "?r=clubs%2Fview&id=".$data->club_id);
                },

            ],
            [
                'attribute' => 'priced_sum',
                'value'  => function ($data) {
                return $data->priced_sum.' '.$data->priced_currency;
                },
            ],
            [
                'attribute' => 'status',
                'label' => Yii::t('backend', 'Status'),
                'value'  => function ($data) {
                return Yii::t('common', $data->status);
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {certificates} {delete}',
                'buttons' => [
                    'certificates' => function ($url,$model) {
                        return Html::a(
                        '<span class="fa fa-clone" title="'.Yii::t('common', 'Certificates').'"></span>', 
                        $url);
                    },
                ],
            ],
        ],
    ]); ?>
</div>