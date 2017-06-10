<?php

/*
 * @link https://itnavigator.org/
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\base\InvalidParamException;
use yii\web\Response;
use yii\bootstrap\ActiveForm;
use yii\data\ActiveDataProvider;

/**
 * The base of the offers management controller
 * 
 * @author Vyacheslav Bodrov <bigturtle@i.ua>
 * @since 1.0
 */
class MoneyController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                        [
                        'actions' => ['index'
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
     * Display the list offers
     *
     * @return mixed
     */
    public function actionIndex() {
        $params = Yii::$app->request->queryParams;
        $query = \backend\models\LogMoney::find();

        $query->andFilterWhere(['user_id' => Yii::$app->user->identity->id]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC],
            ],
        ]);
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);
    }


}
