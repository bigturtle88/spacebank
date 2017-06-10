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

<div class="col-xs-12">
    <p>
    <h2><?= Yii::t('common', 'Packages') ?>   
    </h2>
</p>
</div>

<?php echo $this->render('/dashboard/dashboardTabs'); ?>


<div class="col-xs-12">


    <p>

        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseAddCertificateSell1" aria-expanded="false" aria-controls="collapseAddPackages">


            <?= Yii::t('frontend', 'Add Packages') ?>
        </button>
    </p>

    <div class="1collapse" id="collapseAddCertificateSell">
        <p>
        <div  class="col-xs-12">


            <div class="item panel panel-default"><!-- widgetBody -->
                <div class="panel-heading">
                    <h3 class="panel-title pull-left"><?= Yii::t('frontend', 'Parameters packages') ?></h3>

                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">

                    <?php
                    switch (Yii::$app->user->identity->user_type) {
                        case (User::TYPE_USER) : {
                                echo $this->render('/packages/userCertificates', ['model' => $model, 'model' => $model,
                                    'dataProvider' => $dataProvider,
                                    'dataCertificate' => $dataCertificate,
                                    'searchModel' => $searchModel]);
                                break;
                            }
                        case (User::TYPE_BROKER) : {

                                echo $this->render('/packages/brokerCertificates', ['model' => $model, 'model' => $model,
                                    'dataProvider' => $dataProvider,
                                    'dataCertificate' => $dataCertificate,
                                    'searchModel' => $searchModel]);
                                break;
                            }
                    }
                    ?>
                </div>
                <div class="col-xs-12">
                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            'id',
                                ['label' => Yii::t('frontend', 'Broker'),
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
                                ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {update} {delete}',
                                'buttons' => [
                                    'update' => function ($url, $model, $id) {
                                        if ($model->broker_id == null) {
                                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, ['title' => Yii::t('app', 'Update')]);
                                        }
                                    },
                                    'delete' => function ($url, $model, $id) {
                                        if ($model->broker_id == null) {
                                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, ['title' => Yii::t('app', 'Delete')]);
                                        }
                                    },
                                ],],
                        ],
                    ])
                    ?>
                </div> 
            </div>


        </div>
    </div>    
</div>

