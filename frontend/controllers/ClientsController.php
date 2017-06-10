<?php

/*
 * @link https://itnavigator.org/
 */

namespace frontend\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\OrderBuyForm;
use yii\bootstrap\ActiveForm;
use common\models\Packages;
use yii\data\Pagination;
use frontend\models\BrokersForm;
use common\models\User;
use yii\data\ActiveDataProvider;
use common\models\Broker;

/**
 *  Clients controller
 *
 * @author Vyacheslav Bodrov <bigturtle@i.ua>
 * @since 1.0
 */
class ClientsController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                        [
                        'actions' => [
                            'index',
                            'validation-packages-form',
                            'create-packages',
                            'view',
                            'update',
                            'delete'
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'profile' => ['post'],
                    'certificates' => ['post'],
                    'orders' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Display packages
     * 
     * @return mixed
     */
    public function actionIndex() {
 
        $clients = Broker::find()->where(['broker_id' => Yii::$app->user->identity->id]);
       
        $dataProvider = new ActiveDataProvider([
            'query' =>  $clients,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC],
            ], 'pagination' => [
                'pageSize' => 10,
            ],
        ]);
      
            return $this->render('index', [  'dataProvider' => $dataProvider]);
       
    }

}
