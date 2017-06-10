<?php
/* @var $this yii\web\View */

use frontend\assets\DashboardAsset;
use yii\helpers\Url;
use common\models\User;
DashboardAsset::register($this);

$this->title = Yii::t('common', 'Dashboard');
$this->params['breadcrumbs'][] = $this->title;


$activeTab = function ($controller) {
    return $controller === $this->context->getUniqueId() ? 'active' : '';
};
?>
<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    <li role="dashboard" class="<?= $activeTab("offers") ?>">
        <a href="<?= Url::toRoute("/offers"); ?>" aria-controls="offers" role="tab"  ><?php echo Yii::t('common', 'Offers'); ?></a>
    </li>

    <li role="dashboard"  class="<?= $activeTab("certificates") ?>" >
        <a href="<?= Url::toRoute("/certificates"); ?>" aria-controls="certificate" role="tab" ><?php echo Yii::t('common', 'Certificates'); ?></a>

    </li>
    <li role="dashboard"  class="<?= $activeTab("packages") ?>" >
        <a href="<?= Url::toRoute("/packages"); ?>" aria-controls="packages" role="tab" ><?php echo Yii::t('common', 'Packages'); ?></a>

    </li>
    <li role="dashboard" class="dropdown  <?= $activeTab("orders") ?> <?= $activeTab("orders-buy") ?> <?= $activeTab("orders-sell") ?>">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <?php echo Yii::t('common', 'Orders'); ?> <span class="caret"></span></a>
        </a>
        <ul class="dropdown-menu  ">
          <?php /*  <li role="dashboard">
                <a href="<?= Url::toRoute("/orders-buy"); ?>" aria-controls="orders" role="tab"><?php echo Yii::t('common', 'Buy'); ?></a>
            </li> */?>
            <li role="dashboard">
                <a href="<?= Url::toRoute("/orders-sell"); ?>" aria-controls="orders" role="tab"><?php echo Yii::t('common', 'Sell'); ?></a>
            </li>
        </ul>
    </li>
    <li role="dashboard"  class="<?= $activeTab("deals") ?>" >
        <a href="<?= Url::toRoute("/deals"); ?>" aria-controls="deals" role="tab"><?php echo Yii::t('backend', 'Deals History'); ?></a>
    </li>
    <li role="dashboard"  class="<?= $activeTab("money") ?>" >
        <a href="<?= Url::toRoute("/money"); ?>" aria-controls="money" role="tab"><?php echo Yii::t('backend', 'Payments') ?></a>
    </li>
    <?php if (Yii::$app->user->identity->user_type == User::TYPE_USER or Yii::$app->user->identity->user_type == User::TYPE_CONSOLIDATOR or Yii::$app->user->identity->user_type == null) {
        ?>

        <li role = "dashboard" class = "<?= $activeTab("brokers") ?>" >
            <a href = "<?= Url::toRoute("/brokers") ?>" aria-controls = "profile" role = "tab" ><?php echo Yii::t('common', 'Broker');
        ?></a>


        </li>
    <?php } if (Yii::$app->user->identity->user_type == User::TYPE_BROKER) { ?>

        <li role = "dashboard" class = "<?= $activeTab("clients") ?>" >
            <a href = "<?= Url::toRoute("/clients") ?>" aria-controls = "profile" role = "tab" ><?php echo Yii::t('common', 'Clients');
        ?></a>


        </li>
    <?php }
    ?>
    <li role="dashboard" class="<?= $activeTab("profile") ?>"  >
        <a href="<?= Url::toRoute("/profile") ?>" aria-controls="profile" role="tab"  ><?php echo Yii::t('common', 'Profile'); ?></a>
    </li>

</ul>



