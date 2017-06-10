<?php

/*
 * @link https://itnavigator.org/
 * 
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use common\models\Order;
use frontend\models\ExchangeSearchForm;
use yii\data\Pagination;

/**
 * The base of the Trade
 * 
 * @author Vyacheslav Bodrov <bigturtle@i.ua>
 * @since 1.0
 */
class TradeController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                        [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
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
        ];
    }

    /**
     * Displays  Trade. 
     *
     * @return mixed
     */
    public function actionIndex() {

}

    /**
     * Displays  Room of offer. 
     *
     * @return mixed
     */
    public function actionRoom() {

}

}


