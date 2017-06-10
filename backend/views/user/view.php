<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">
    <p>
        <?= Html::a(Yii::t('backend', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            'email:email',
            'fio',
            'tel',
            'is_individual:boolean',
            'contact',
            'firm_name',
            'money',
            'status:boolean',
            [
                'attribute' => 'user_type',
                'label' => Yii::t('backend', 'Status'),
                'value'  => call_user_func(function ($data) {
                if(!$data->user_type)$data->user_type='User';
                return Yii::t('common', $data->user_type);
                }, $model),
            ],
            [
                'attribute' => 'created_at',
                'format' =>  ['date', 'Y-MM-dd HH:mm'],
                'label' => Yii::t('common', 'Signup'),
            ],
            [
                'attribute' => 'updated_at',
                'format' =>  ['date', 'Y-MM-dd HH:mm'],
                'label' => Yii::t('backend', 'Changed'),
            ],
        ],
    ])
    ?>

</div>
