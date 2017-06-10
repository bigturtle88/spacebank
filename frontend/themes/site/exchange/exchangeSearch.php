<?php

use yii\widgets\ActiveForm;
use common\models\Order;
use \yii\helpers\Html;
use kartik\select2\Select2;

$dropDownListOrdersType = [
    Order::TYPE_SELL => Yii::t('frontend', 'Sell'),
    Order::TYPE_BUY => Yii::t('frontend', 'Buy')
];
$dropDownListDefult = [
    'prompt' => Yii::t('frontend', 'All...')
];
?>


<?php
$form = ActiveForm::begin([
            'id' => $model->formName(),
            'method' => 'post'
        ]);
?>

<div  class="col-xs-12">
    <div class="panel panel-default">
        <div class="panel-heading"><?= Yii::t('frontend', 'Search') ?></div>
        <div class="panel-body">


            <div class="input-group input-group-sm ">
                <div class="row">
                    <div class="col-xs-4">     
                        <?=
                        $form->field($model, 'country_id')->widget(Select2::classname(), [
                            'name' => 'country_id',
                            'data' => common\models\Country::getCountryList(), // initial value
                            'maintainOrder' => true,
                            'showToggleAll' => false,
                            'options' => [
                                'multiple' => true],
                            'pluginOptions' => [
                                'type' => 'GET',
                                'allowClear' => true,
                                'maximumInputLength' => 2
                            ],
                        ])
                        ?>

                    </div> 
                    <div class="col-xs-2">   
                        <?= $form->field($model, 'club_id')->dropDownList(common\models\Club::getClubList(), $dropDownListDefult, ['name' => 'club_id']); ?> 

                    </div>        
                    <div class="col-xs-2">
                        <?=
                        $form->field($model, 'apartment_type_id')->widget(Select2::classname(), [
                            'name' => 'apartment_type_id',
                            'data' => common\models\ApartmentType::getApartmentTypeList(), // initial value
                            'maintainOrder' => true,
                            'showToggleAll' => false,
                            'options' => [
                                'multiple' => true],
                            'pluginOptions' => [
                                'type' => 'GET',
                                'allowClear' => true,
                                'maximumInputLength' => 10
                            ],
                        ]);
                        ?> 



                    </div>
                    <div class="col-xs-2">        
                        <?=
                        $form->field($model, 'season_id')->widget(Select2::classname(), [
                            'name' => 'season_id',
                            'value' => (!empty(Yii::$app->request->get()["country_id"])) ? Yii::$app->request->get()["country_id"] : null,
                            'data' => common\models\Season::getSeasonList(), // initial value
                            'maintainOrder' => true,
                            'showToggleAll' => false,
                            'options' => [
                                'multiple' => true],
                            'pluginOptions' => [
                                'type' => 'GET',
                                'allowClear' => true,
                                'maximumInputLength' => 10
                            ],
                        ]);
                        ?> 


                    </div>


                    <div class="col-xs-12" >   
                        <div class="row">
                            <div class="col-xs-2" > 
                                <?=
                                $form->field($model, 'price_from')->textInput();
                                ?>  
                            </div>   
                            <div class="col-xs-2" > 
                                <?=
                                $form->field($model, 'price_to')->textInput();
                                ?>  
                            </div>    

                            <div class="col-xs-2">        
                                <?= $form->field($model, 'order_type')->dropDownList($dropDownListOrdersType, $dropDownListDefult, ['name' => 'order_type']); ?> 

                            </div>
                        </div>  
                    </div>  

                </div>


            </div>
            <p>

            <div class="col-xs-12">         
                <div class="row">

                    <?= Html::submitButton(Yii::t('frontend', 'Search'), ['class' => 'btn btn-info', 'name' => 'signup-button']) ?>


                </div>
            </div>
            </p>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
 
