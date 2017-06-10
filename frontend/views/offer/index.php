<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\OfferSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Offers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="offer-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Offer', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'seller_id',
            'buyer_id',
            'status',
            'source_id',
            // 'bid',
            // 'expertise',
            // 'expert_price',
            // 'description',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
