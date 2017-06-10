<?php

//$this->title = "admin page"; 
use yii\helpers\Url;
use yii\helpers\Html;
$url = ['site/index', 'page' => 10, 'sort' => 'name'];
?>

<h1>Admin test </h1>

<?=
Html::a('<b>Register</b>', 
    ['test/admin', 'id' =>39,'name'=>'11'])
?>
<br/>
<?=
Html::a('12345', 
    ['test/admin', 'id' =>45,'name'=>'22'])
?>
<br>
<?=
Html::a('ol', 
    ['test/admint'])
?>

<?=
Html::a('oll', 
    ['test'])
?>
<br>
<br>
