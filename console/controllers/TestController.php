<?php

namespace console\controllers;

use Yii;
use yii\helpers\Console;

class TestController extends \yii\console\Controller {

    public function actionHello() {
        $g=0;
        $posts = Yii::$app->db->createCommand("SELECT id,club_id FROM certificates WHERE club_id2='' LIMIT 0,2000")
            ->queryAll();
    foreach ($posts as $key => $value) {
        $value['club_id']=trim($value['club_id'],';');
        $value['club_id']=str_replace(';',',',$value['club_id']);
        Yii::$app->db->createCommand("UPDATE certificates SET club_id2='".$value['club_id']."' WHERE id='".$value['id']."'")
        ->execute();
        $g++;
    }

        echo $this->stdout($g . " сертификатов изменено.\n", Console::FG_GREEN, Console::BOLD);
    }  
 
}