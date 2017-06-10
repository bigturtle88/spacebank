<?php

/*
 * @link https://itnavigator.org/
 * 
 */

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\Response;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * The base of the Dashboard
 * 
 * @author Vyacheslav Bodrov <bigturtle@i.ua>
 * @since 2.0
 */
class DashboardController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                        [
                        'actions' => ['index',
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
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
     * Displays Dashboard. Redirect Offers
     *
     * @return mixed
     */
    public function actionIndex() {
        return $this->redirect('offers');
    }

}
