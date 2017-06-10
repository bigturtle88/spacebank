<?php
/* @var $this yii\web\View */

use frontend\assets\DashboardAsset;

DashboardAsset::register($this);

$this->title = Yii::t('common', 'Dashboard');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dashboard">

    <div>

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="dashboard" class="active">
                <a href="<?= offers ?>" aria-controls="offers" role="tab" data-toggle="tab"><?php echo Yii::t('common', 'Offers'); ?></a>
            </li>
            <li role="dashboard" class="active"> <?php //Измененно на время заполнения     ?>
                <a href="#certificates" aria-controls="certificate" role="tab" data-toggle="tab"><?php echo Yii::t('common', 'Certificates'); ?></a>
            </li>
            <li role="dashboard" class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <?php echo Yii::t('common', 'Orders'); ?> <span class="caret"></span></a>
                </a>
                <ul class="dropdown-menu">
                    <li role="dashboard">
                        <a href="#orders-bay" aria-controls="orders" role="tab" data-toggle="tab"><?php echo Yii::t('common', 'Buy'); ?></a>
                    </li>
                    <li role="dashboard">
                        <a href="#orders-sell" aria-controls="orders" role="tab" data-toggle="tab"><?php echo Yii::t('common', 'Sell'); ?></a>
                    </li>
                </ul>
            </li>
            <li role="dashboard" > <?php //Измененно на время заполнения     ?>
                <a href="#offers" aria-controls="offers" role="tab" data-toggle="tab"><?php echo Yii::t('common', 'Offers'); ?></a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane" id="offers">
                <?php
                echo $this->render('offers_tab', ['dataProvider' => $dataProvider,
                    'searchModel' => $searchModel]);
                ?>
            </div>
            <div role="tabpanel" class="tab-pane active" id="certificates"><?php //Измененно на время заполнения     ?>
                <?php echo $this->render('certificates_tab'); ?>
            </div>
            <div role="tabpanel" class="tab-pane" id="orders-bay">
                <?php echo $this->render('orders_buy_tab'); ?>
            </div>
            <div role="tabpanel" class="tab-pane" id="orders-sell">
                <?php echo $this->render('orders_sell_tab'); ?>
            </div>
            <div role="tabpanel" class="tab-pane" id="profile">
            <div role="tabpanel" class="tab-pane " id="offers">
                <?php
                echo $this->render('offers_tab', ['dataProvider' => $dataProvider,
                    'searchModel' => $searchModel]);
                ?>
            </div>
        </div>

    </div>

</div>
