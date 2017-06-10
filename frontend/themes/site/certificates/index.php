<?php

use common\models\Certificate;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<div class="col-xs-12">
    <p>
    <h2> <?= Yii::t('common', 'Certificates') ?>  


    </h2>
</p>
</div>
<?php
?>
<?php echo $this->render('/dashboard/dashboardTabs'); ?>
<?php echo $this->render('form'); ?>

<div class="col-xs-12">
    <div class="row">

        <?php foreach ($certificates as $certificate) { ?>      
            <div class="panel-group" id="accordion-<?= $certificate->id ?>  " role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="heading-<?= $certificate->id ?>  ">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-<?= $certificate->id ?>" aria-expanded="true" aria-controls="collapse-<?= $certificate->id ?> ">
                                <?= Yii::t('frontend', 'Certificate') ?>  <?= '№' . $certificate->certificate_code ?>  

                                <?php
                                if ($certificate->broker_id != Null) {
                                    $broker = common\models\User::findOne($certificate->broker_id);
                                 
                                    ?>
                                    <?= '(' . Yii::t('frontend', 'Broker') ,' ',     $broker->username. ')' ?>

                                <?php } ?>

                            </a>
                        </h4>
                    </div>
                    <div id="collapse-<?= $certificate->id ?>" class="panel-collapse collapse in collapse-certificate" role="tabpanel" aria-labelledby="heading-<?= $certificate->id ?> ">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-4">
                                    <br>  <?= Yii::t('frontend', 'Code of certificate') . ': ' . $certificate->certificate_code ?> </br>
                                    <br>  <?= Yii::t('frontend', 'Date of start') . ': ' . $certificate->start_date ?> </br>
                                    <br>  <?= Yii::t('frontend', 'Date of end') . ': ' . $certificate->end_date ?> </br>
                                    <br>  <?= Yii::t('frontend', 'Certificate period') . ': ' . $certificate->certificate_period ?> </br>
                                    <br>  <?= Yii::t('frontend', 'Certificate costs') . ': ' . $certificate->certificate_sum . ' ' . $certificate->certificate_currency ?> </br>


                                </div>
                                <div class="col-xs-4">
                                    <br>  <?= Yii::t('frontend', 'Country') . ': ' . $certificate->getCountry()->name ?> </br>
                                    <br>  <?= Yii::t('frontend', 'Club') . ': ' . $certificate->getClub()->name ?> </br>
                                    <br>  <?= Yii::t('frontend', 'Company') . ': ' . $certificate->getCompany()->name ?> </br>
                                    <br>  <?= Yii::t('frontend', 'Apartment type') . ': ' . $certificate->getApartmentType()->name; ?> </br>
                                    <br>  <?= Yii::t('frontend', 'Season') . ': ' . $certificate->getSeason()->name; ?> </br>
                                    <br>  <?= Yii::t('frontend', 'Number of intervals') . ': ' . $certificate->interval_numbers; ?> </br>

                                </div>
                                <div class="col-xs-4">
                                    <br>  <?= Yii::t('frontend', 'Bonus weeks') . ': ' . $certificate->bonus_weeks ?> </br> 
                                    <br>  <?=
                                    Yii::t('frontend', 'Expertize') . ': ';
                                    echo $certificate->is_expertize == 0 ? 'No' : 'Yes'
                                    ?> </br> 
                                    <br>  <?=
                                    Yii::t('frontend', 'Priced') . ': ';
                                    echo $certificate->is_priced == 0 ? 'No' : 'Yes'
                                    ?> </br> 



                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        <?php } ?>
        <?=
        yii\widgets\LinkPager::widget([
            'pagination' => $pages,
        ]);
        ?>


    </div>
</div>
