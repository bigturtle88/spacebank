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
use common\models\Order;
use yii\data\Pagination;

/**
 *  Orders to buy controller
 *
 * @author Vyacheslav Bodrov <bigturtle@i.ua>
 * @since 1.0
 */
class OrdersBuyController extends Controller {

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
                            'validation-order-buy-form'
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
     * Display order, add order buy.
     * 
     * @param integer $id orders
     * @return mixed
     */
    public function actionIndex() {

        $orders = Order::find()->where(['user_id' => Yii::$app->user->identity->id, 'type' => Order::TYPE_BUY]);
        $pages = new Pagination(['totalCount' => $orders->count()]);
        $list = $orders->offset($pages->offset)
                ->limit($pages->limit)
                ->all();
        $modelOrderBuyForm = new OrderBuyForm();
        if ($modelOrderBuyForm->load(Yii::$app->request->post()) && $modelOrderBuyForm->validate()) {
            if ($modelOrderBuyForm->save()) {
                Yii::$app->session->setFlash('success', 'Предложение о покупке успешно добавлено.');
                return $this->refresh();
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка добавления предложения о покупке.');
                return $this->render('index', ['model' => $modelOrderBuyForm, 'orders' => $list, 'pages' => $pages]);
            }
        } else {
            return $this->render('index', ['model' => $modelOrderBuyForm, 'orders' => $list, 'pages' => $pages]);
        }
    }

    /**
     * Validation Order form adding buy order
     *
     * 
     * @return mixed
     */
    public function actionValidationOrderBuyForm() {
        $model = new OrderBuyForm();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }

}
