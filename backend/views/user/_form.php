<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use common\models\Broker;
use common\models\User;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use yii\db\Query;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */

$script = <<< JS
    function isFirm(date){
        if(date.checked === true){
            $('.is_firm').show();
        }else{
            $('.is_firm').hide();
        }
    };
JS;

if (!$model->is_individual || $model->is_individual === 0)
    $this->registerCss(".is_firm {display:none;}");

$this->registerJs($script, yii\web\View::POS_BEGIN);
?>
<?php if($model->id){ ?>
<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#home"><?= Yii::t('backend', 'Profile') ?></a></li>
  <?php if($model->user_type!='Broker'){ ?>
  <li><a data-toggle="tab" href="#menu1"><?= Yii::t('common', 'Brokers') ?></a></li>
  <?php }else{ ?>
  <li><a data-toggle="tab" href="#menu2"><?= Yii::t('backend', 'Users') ?></a></li>
  <li><a data-toggle="tab" href="#menu3"><?= Yii::t('common', 'Consolidators') ?></a></li>
  <?php } ?>
</ul>
<?php } ?>

<div class="tab-content">
  <div id="home" class="tab-pane fade in active">
      <br>
        <div class="user-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'username')->textInput() ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'password_repeat')->passwordInput() ?>

        <?= $form->field($model, 'email')->textInput() ?>

        <?= $form->field($model, 'fio')->textInput() ?>

        <?= $form->field($model, 'tel')->textInput() ?>

        <?= $form->field($model, 'is_individual')->checkbox(['class' => 'isFirm', 'onchange' => 'isFirm(this);']) ?>
        <div class="is_firm">
            <?= $form->field($model, 'contact')->textInput() ?>

            <?= $form->field($model, 'firm_name')->textInput() ?>
        </div>

        <?= $form->field($model, 'money')->textInput() ?>

        <?= $form->field($model, 'status')->checkbox() ?>

        <?= $form->field($model, 'user_type')->dropDownList([
                            'User' => Yii::t('common', 'User'),
                            'Broker' => Yii::t('common', 'Broker'),
                            'Consolidator' => Yii::t('common', 'Consolidator')
                        ])->label(Yii::t('backend', 'Status')) ?>
      </div>
  </div>
  <div id="menu1" class="tab-pane fade">
      <br>
      <?php 
        $query = new Query;
        $query->select(['id', 'username'])
            ->from('user')
            ->where(['user_type' => 'Broker'])
            ->all();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $_GET['selrow']='user_id';
        if($model->user_type=='Consolidator')$_GET['selrow']='consolidator_id';
      ?>
     <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'id',
                'options' => ['width' => '30'],
            ],
            [
                'attribute' => 'username',
                'label' => Yii::t('backend', 'User name'),
                'format'=>'raw',
                'value'=>function ($data) {
                    return Html::a($data['username'], "?r=user%2Fupdate&id=".$data['id']);
                },
            ],
            [
                'attribute' => 'procent',
                'label' => Yii::t('backend', 'Procent'),
                'value' => function($data){
                    $procent=(new \yii\db\Query())  
                        ->select(['procent'])
                        ->from('broker')
                        ->where([$_GET['selrow'] => $_GET['id'], 'broker_id' => $data['id']])
                        ->limit(1)
                        ->scalar();
                    return Html::textInput('procent[]', $procent, ['class' => 'form-control','style' => ['width' => '50px']]);
                },
                'format' => 'raw',
            ],
            ['class' => 'yii\grid\CheckboxColumn',
                'name' => 'brokers', 'checkboxOptions' => ['onclick' => 'js:addItems(this.value, this.checked)'],
                'checkboxOptions' => function ($data) {
                    $checked=(new \yii\db\Query())  
                        ->select(['broker_id'])
                        ->from('broker')
                        ->where([$_GET['selrow'] => $_GET['id'], 'broker_id' => $data['id'], 'is_active' => 1])
                        ->limit(1)
                        ->scalar();
                    return ['value' => trim($data['id']), 'checked' => $checked];
                }
            ],
        ],
    ]);
    ?>
  </div>
  <div id="menu2" class="tab-pane fade">
    <br>
      <?php 
        $query = new Query;
        $query->select(['user_id', 'procent'])
            ->from('broker')
            ->where(['broker_id' => $model->id, 'is_active' => 1])
            ->andWhere(['>', 'user_id', 0])
            ->all();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

      ?>
     <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'user_id',
                'options' => ['width' => '50'],
                'label' => Yii::t('backend', 'User'),
                'format'=>'raw',
                'value'=>function ($data) {
                    return Html::a(User::findOne($data['user_id'])->username, "?r=user%2Fupdate&id=".$data['user_id']);
                },

            ],
            [
                'attribute' => 'procent',
                'label' => Yii::t('backend', 'Procent'),
                'value'=>function ($data) {
                    return $data['procent'].' %';
                },
            ],
        ],
    ]);
    ?>

  </div>
  <div id="menu3" class="tab-pane fade">
        <?php 
        $query = new Query;
        $query->select(['consolidator_id', 'procent'])
            ->from('broker')
            ->where(['broker_id' => $model->id, 'is_active' => 1])
            ->andWhere(['>', 'consolidator_id', 0])
            ->all();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

      ?>
     <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'consolidator_id',
                'options' => ['width' => '50'],
                'label' => Yii::t('backend', 'User'),
                'format'=>'raw',
                'value'=>function ($data) {
                    return Html::a(User::findOne($data['consolidator_id'])->username, "?r=user%2Fupdate&id=".$data['consolidator_id']);
                },

            ],
            [
                'attribute' => 'procent',
                'label' => Yii::t('backend', 'Procent'),
                'value'=>function ($data) {
                    return $data['procent'].' %';
                },
            ],
        ],
    ]);
    ?>

  </div>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
