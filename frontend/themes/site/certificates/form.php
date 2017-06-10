<?php

use frontend\models\CertificateForm;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
?>

<?php $model = new CertificateForm(); ?>

<div class="col-xs-12">

    <?php
    $form = ActiveForm::begin([
                'id' => $model->formName(),
                'enableAjaxValidation' => true,
                'validationUrl' => Url::toRoute('validation-certificate-form'),
                //      'action' => Url::toRoute('certificate-form'),
                'options' => ['enctype' => 'multipart/form-data'],
    ]);
    ?>

    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseAddCertificate" aria-expanded="false" aria-controls="collapseAddCertificate">
        <?= Yii::t('frontend', 'Add certificate'); ?>
    </button>

    <div class="collapse" id="collapseAddCertificate">
        <p>
        <div  class="col-xs-12" >
            <div class="panel panel-default">
                <div class="panel-heading"><?= Yii::t('common', 'Legal details of the timeshare') ?></div>
                <div class="panel-body ">
                    <div class="input-group input-group-sm row"> 
                        <div class="col-xs-3"> 
                            <?= $form->field($model, 'certificate_code')->textInput(['class' => 'form-control']) ?> 
                        </div>
                        <div class="col-xs-3">       
                            <?=
                            $form->field($model, 'start_date')->widget(\dosamigos\datepicker\DatePicker::className(), [
                                'template' => '{addon}{input}',
                                'clientOptions' => [
                                    'autoclose' => true,
                                    'format' => 'yyyy-mm-dd'
                                ]
                            ])
                            ?>   </div> 
                        <div class="col-xs-3">     
                            <?=
                            $form->field($model, 'end_date')->widget(\dosamigos\datepicker\DatePicker::className(), [
                                'template' => '{addon}{input}',
                                'clientOptions' => [
                                    'autoclose' => true,
                                    'format' => 'yyyy-mm-dd'
                                ]
                            ])
                            ?> 
                        </div>
                        <div class="col-xs-3"> 
                            <?=
                            $form->field($model, 'certificate_period')->dropDownList(common\models\Certificate::$CERTIFICATE_PERIOD_ARRAY)
                            ?>  
                        </div>  
                    </div>
                    <div class="input-group input-group-sm row">
                        <div class="col-xs-3"> 
                            <?= $form->field($model, 'contract_code')->textInput() ?>
                        </div> 
                        <div class="col-xs-3"> 
                            <?=
                            $form->field($model, 'contract_date')->widget(\dosamigos\datepicker\DatePicker::className(), [
                                'template' => '{addon}{input}',
                                'clientOptions' => [
                                    'autoclose' => true,
                                    'format' => 'yyyy-mm-dd'
                                ]
                            ])
                            ?>

                        </div> 
                        <div class="col-xs-3"> 
                            <?= $form->field($model, 'certificate_sum')->textInput() ?>
                        </div> 
                        <div class="col-xs-1"> 
                            <?= $form->field($model, 'certificate_currency')->dropDownList(array(''=>'') + common\models\CurrenciesQuery::getCurrenciesList()) ?>
                        </div> 
                    </div>
                </div>
            </div>


            <div class="panel panel-default">
                <div class="panel-heading"><?= Yii::t('common', 'Parameters timeshare') ?></div>
                <div class="panel-body">

                    <div class="input-group input-group-sm row">

                        <div class="col-xs-3">     
                            <?= $form->field($model, 'country_id')->dropDownList(array(''=>'') + common\models\Country::getCountryList()) ?>
                        </div> 
                        <div class="col-xs-3">   
                            <?= $form->field($model, 'club_id')->dropDownList(array(''=>'') + common\models\Club::getClubList()); ?> 

                        </div>        
                        <div class="col-xs-2">
                            <?= $form->field($model, 'apartment_type_id')->dropDownList(array(''=>'') + common\models\ApartmentType::getApartmentTypeList()); ?> 
                        </div>
                        <div class="col-xs-2">        
                            <?= $form->field($model, 'season_id')->dropDownList(array(''=>'') + common\models\Season::getSeasonList()); ?> 
                        </div>
                        <div class="col-xs-2">   
                            <?= $form->field($model, 'company_id')->dropDownList(array(''=>'') + common\models\Company::getCompanyList()); ?> 

                        </div>  
                    </div>

                    <div class="input-group input-group-sm row">

                        <div class="col-xs-2">   
                            <?= $form->field($model, 'interval')->textInput() ?>    
                        </div>
                        <div class="col-xs-2"> 
                            <?= $form->field($model, 'interval_numbers')->textInput() ?>      
                        </div>    

                        <div class="col-xs-4">  
                            <?= $form->field($model, 'apartment_number')->textInput() ?></div>
                        <div class="col-xs-2"> <?= $form->field($model, 'bonus_weeks')->textInput() ?>  </div>    

                        <div class="col-xs-2"> <?= $form->field($model, 'points')->textInput() ?> 

                        </div> 
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading"><?= Yii::t('common', 'Information on membership fees') ?> </div>
                <div class="panel-body">
                    <div class="input-group input-group-sm row">
                        <div class="col-xs-4"> 
                            <?= $form->field($model, 'fees_start_sum')->textInput() ?>
                        </div>   
                        <div class="col-xs-2"> 
                            <?= $form->field($model, 'fees_start_currency')->dropDownList(array(''=>'') + common\models\CurrenciesQuery::getCurrenciesList()) ?>
                        </div>
                        <div class="col-xs-3">   
                            <?= $form->field($model, 'fees_current_sum')->textInput() ?></div>
                        <div class="col-xs-1">   


                            <?= $form->field($model, 'fees_current_currency')->dropDownList(array(''=>'') + common\models\CurrenciesQuery::getCurrenciesList()) ?>     
                        </div>
                    </div>  

                    <div class="input-group input-group-sm row"> 




                        <div class="col-xs-2"> 
                            <?= $form->field($model, 'is_penalty')->checkBox(['uncheck' => '0', 'value' => '1']) ?>      
                        </div>
                        <div class="col-xs-2">        <?= $form->field($model, 'penalty_start_sum')->textInput() ?>
                        </div>   
                        <div class="col-xs-2">  
                            <?= $form->field($model, 'penalty_start_currency')->dropDownList(array(''=>'') + common\models\CurrenciesQuery::getCurrenciesList()) ?>   
                        </div>

                        <div class="col-xs-3">
                            <?= $form->field($model, 'fees_loan_sum')->textInput() ?>  
                        </div>
                        <div class="col-xs-1">
                            <?= $form->field($model, 'fees_loan_currency')->dropDownList(array(''=>'') + common\models\CurrenciesQuery::getCurrenciesList()) ?> 

                        </div>

                    </div>

                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading"><?= Yii::t('common', 'Additional details of the timeshare') ?></div>
                <div class="panel-body">
                    <div class="row"> 
                        <div class="col-xs-4"> 
                            <?= $form->field($model, 'certificate_loan_sum')->textInput() ?> 
                        </div> 

                        <div class="col-xs-1"> 
                            <?= $form->field($model, 'certificate_loan_currency')->dropDownList(array(''=>'') + common\models\CurrenciesQuery::getCurrenciesList()) ?>
                        </div> 

                        <div class="col-xs-4"> 

                            <div class="row">
                                <div class="col-xs-4">   
                                    <?= $form->field($model, 'is_membership')->checkBox(['uncheck' => '0', 'value' => '1']) ?>

                                </div>
                                <div class="col-xs-4">    
                                    <?= $form->field($model, 'is_expertize')->checkBox(['uncheck' => '0', 'value' => '1']) ?>
                                </div>

                            </div>

                        </div>
                    </div>


                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading"><?= Yii::t('common', 'Additional details of the timeshare') ?></div>
                <div class="panel-body">
                    <div class="row">

                        <div class="col-xs-3"> 
                            <?= $form->field($model, 'is_priced')->checkBox(['uncheck' => '0', 'value' => '1']) ?>
                        </div>   
                        <div class="col-xs-4"> 
                            <?= $form->field($model, 'priced_sum')->textInput() ?> 
                        </div> 

                        <div class="col-xs-1"> <h5>
                                <?= $form->field($model, 'priced_currency')->dropDownList(array(''=>'') + common\models\CurrenciesQuery::getCurrenciesList()) ?>  
                            </h5></div> 

                    </div>   
                </div>
            </div>

            <?= $form->field($model, 'certificate_file')->fileInput(); ?>

            <div class="form-group">
                <?= Html::submitButton(Yii::t('common', 'Save'), ['class' => 'btn btn-info', 'name' => 'signup-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
        <p>
    </div>
</div>