<?php

use yii\helpers\Html;
use yii\grid\GridView;
use leandrogehlen\treegrid\TreeGrid;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PagesModelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend','Pages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-model-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('backend','Create Page'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    /* GridView::widget([
      'dataProvider' => $dataProvider,
      'filterModel' => $searchModel,
      'columns' => [
      ['class' => 'yii\grid\SerialColumn'],

      'id',
      'title',
      'content',
      'status',

      ['class' => 'yii\grid\ActionColumn'],
      ],
      ]); */


    TreeGrid::widget([
        'dataProvider' => $dataProvider,
        'keyColumnName' => 'id',
        'parentColumnName' => 'parent',
        'parentRootValue' => '0', //first parentId value
        'pluginOptions' => [
            'initialState' => 'expanded',
        ],
        'options' => ['class' => 'table table-striped table-bordered js-ajax-checkbox js-sortable-table', 'data-href' => "/admin/objects"],
        //'tableOptions' => [],
        'columns' => [
            //'id',
            'title',
            //'content',
            'status:boolean',
            ['class' => 'yii\grid\ActionColumn']
        ]
    ]);
    ?>
</div>
