<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use common\components\MenuT;
use yii\helpers\Url;

AppAsset::register($this);

use nirvana\showloading\ShowLoadingAsset;

ShowLoadingAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => Yii::t('common', 'My Company'),
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            $menuItems = [
                    ['label' => Yii::t('common', 'Home'), 'url' => Yii::$app->homeUrl],
            ];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => Yii::t('common', 'Signup'), 'url' => ['/site/signup']];
                $menuItems[] = ['label' => Yii::t('common', 'Login'), 'url' => ['/site/login']];
            } else {
                $menuItems[] = ['label' => Yii::t('common', 'Exchange'), 'url' => ['/exchange']];
                $menuItems[] = ['label' => Yii::t('common', 'Dashboard'), 'url' => ['/dashboard']];

                $menuItems[] = '<li>'
                        . '<a href="' . Url::toRoute('/money') . '">' . Yii::t('frontend', 'Balans') . ' '
                        . Yii::$app->user->identity->money
                        . ' <span class="glyphicon glyphicon-credit-card"><span>'
                        . '</a> '
                        . '</li>';

                $menuItems[] = '<li>'
                        . Html::beginForm(['/site/logout'], 'post')
                        . Html::submitButton(
                                Yii::t('common', 'Logout') . '(' . Yii::$app->user->identity->username . ')', ['class' => 'btn btn-link']
                        )
                        . Html::endForm()
                        . '</li>';
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                //'items' => MenuT::getMenu(),
                'items' => $menuItems,
            ]);
            NavBar::end();
            ?>

            <div class="container">
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

                <p class="pull-right"><?= Yii::powered() ?></p>
            </div>
        </footer>

        <?php $this->endBody() ?>

        <?php
        yii\bootstrap\Modal::begin([
            'header' => '<div id="modalHeader"></div>',
            'id' => 'modal',
            'size' => 'modal-lg',
            //keeps from closing modal with esc key or by clicking out of the modal.
            // user must click cancel or X to close
            'clientOptions' => ['backdrop' => 'static']
        ]);
        echo "<div id='modalContent'></div>";
        yii\bootstrap\Modal::end();
        
        ?>

    </body>
</html>
<?php $this->endPage() ?>
