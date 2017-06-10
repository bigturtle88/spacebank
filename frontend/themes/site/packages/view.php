<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Offer */
?>


<div class="col-xs-12">
    <p>
    <h2><?= Yii::t('common', 'Packages') ?>   
    </h2>
</p>
</div>


<?php echo $this->render('/dashboard/dashboardTabs'); ?>
<div class="offer-view">

    <h1><?php //= Html::encode($this->title)          ?></h1>

    <p>
<?= Html::a(Yii::t('frontend', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php
//        Html::a('Delete', ['delete', 'id' => $model->id], [
//            'class' => 'btn btn-danger',
//            'data' => [
//                'confirm' => 'Are you sure you want to delete this item?',
//                'method' => 'post',
//            ],
//        ])
        ?>
    </p>

<?=
DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
            [
            'attribute' => 'user_id',
            'label' => Yii::t('backend', 'User'),
            'format' => 'raw',
            'value' => call_user_func(function ($data) {
                        return common\models\User::findOne($data->user_id)->username;
                    }, $model),
        ],
            [
            'attribute' => 'club_id',
            'format' => 'raw',
            'value' => call_user_func(function ($data) {
                        return common\models\Club::findOne($data->club_id)->name;
                    }, $model),
        ],
            [
            'attribute' => 'quantity',
            'label' => Yii::t('common', 'List of certificates'),
            'format' => 'raw',
            'value' => call_user_func(function ($data) {
                        $arr = common\models\Certificate::getCertificatesPackageList($data->id);
                        if ($arr) {
                            $list = '';
                            foreach ($arr as $a => $v) {
                                $list .= $v . '<br>';
                            }
                            return $list;
                        }
                    }, $model),
        ],
            [
            'attribute' => 'country_id',
            'format' => 'raw',
            'value' => call_user_func(function ($data) {
                        if ($data->country_id) {
                            $arr = array_unique(explode(',', trim($data->country_id, ',')));
                            $list = '';
                            
                            foreach ($arr as $a) {
                                $list .= common\models\Country::findOne($a)->name.'<br>';
                            }
                            return $list;
                        }
                    }, $model),
        ],
            [
            'attribute' => 'company',
            'format' => 'raw',
            'value' => call_user_func(function ($data) {
                        if ($data->company) {
                            $arr = array_unique(explode(',', trim($data->company, ',')));
                            $list = '';
                            foreach ($arr as $a) {
                                $list .= common\models\Company::findOne($a)->name . '<br>';
                            }
                            return $list;
                        }
                    }, $model),
        ],
            [
            'attribute' => 'apartment_type_id',
            'format' => 'raw',
            'value' => call_user_func(function ($data) {
                        if ($data->apartment_type_id) {
                            $arr = array_unique(explode(',', trim($data->apartment_type_id, ',')));
                            $list = '';
                            foreach ($arr as $a) {
                                $list .= common\models\ApartmentType::findOne($a)->name . '<br>';
                            }
                            return $list;
                        }
                    }, $model),
        ],
            [
            'attribute' => 'certificate_period',
            'format' => 'raw',
            'value' => call_user_func(function ($data) {
                        if ($data->certificate_period) {
                            $arr = array_unique(explode(',', trim($data->certificate_period, ',')));
                            $list = '';
                            foreach ($arr as $a) {
                                $list .= $a . '<br>';
                            }
                            return $list;
                        }
                    }, $model),
        ],
            [
            'attribute' => 'season_id',
            'format' => 'raw',
            'value' => call_user_func(function ($data) {
                        if ($data->season_id) {
                            $arr = array_unique(explode(',', trim($data->season_id, ',')));
                            $list = '';
                            foreach ($arr as $a) {
                                $list .= common\models\Season::findOne($a)->name . '<br>';
                            }
                            return $list;
                        }
                    }, $model),
        ],
        'quantity',
        'priced_sum',
        'priced_currency',
        'is_active:boolean',
        'is_blocked:boolean',
            [
            'attribute' => 'status',
            'label' => Yii::t('backend', 'Status'),
            'value' => call_user_func(function ($data) {
                        return Yii::t('common', $data->status);
                    }, $model),
        ],
            [
            'attribute' => 'created_at',
            'format' => ['date', 'Y-MM-dd HH:mm'],
            'label' => Yii::t('backend', 'Created at'),
        ],
            [
            'attribute' => 'updated_at',
            'format' => ['date', 'Y-MM-dd HH:mm'],
            'label' => Yii::t('backend', 'Updated at'),
        ],
    ],
])
?>

</div>
