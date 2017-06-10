<?php

/*
 * @link https://itnavigator.org/
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use common\models\Season;

/**
 * The base of the offers management controller
 * 
 * @author Vyacheslav Bodrov <bigturtle@i.ua>
 * @since 1.0
 */
class SeasonsLoadController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                   // 'index' => ['POST'],
                ],
            ],
        ];
    }

    public function beforeAction($action)
	{
		$this->enableCsrfValidation = false;
		
		return parent :: beforeAction($action);
	}
    /**
     * Display the list offers
     *
     * @return mixed
     */
    public function actionIndex() {
        $params=Yii::$app->request->post();
        $password=(new \yii\db\Query())  
            ->select(['value'])
            ->from('config')
            ->where(['key' => 'password'])
            ->scalar();
        if($password==$params['password']){
            Yii::$app->db->createCommand()->update('seasons', [
                    'is_active_server' => 0,
                    ])->execute();
            foreach($params[0] as $c){
                $c['ready']=(new \yii\db\Query())  
                ->select(['id'])
                ->from('seasons')
                ->where(['id' => $c['id']])
                ->scalar();
                if(!$c['ready']){
                    Yii::$app->db->createCommand()->insert('seasons', [
                    'id' => $c['id'],
                    'name' => $c['name'],
                    'description' => $c['description'],
                    'is_active' => 1,
                    'is_active_server' => 1,
                    'created_at' => date('Ymd'),
                    'updated_at' => date('Ymd'),
                    ])->execute();
                }
                else{
                    Yii::$app->db->createCommand()->update('seasons', [
                    'is_active_server' => 1,
                    ],['id' => $c['id']])->execute();
                }
            }
            return true;
        }
        else return false;
        
    }


}
