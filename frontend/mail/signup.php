<?php

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

$url = Url::toRoute(['create-profile', 'token' => $user->email_confirm_token]);

?>
Вы зарегистрировались! На ваш почтовый ящик <?= Html::encode($user->email) ?> выслано письмо для регистрации. 
Для завершения регистрации Вы должны пройти по ссылке.


<p> <?= Html::a(Html::encode($url), $url) ?></p>

