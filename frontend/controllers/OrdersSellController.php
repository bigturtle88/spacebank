<?php

/*
 * @link https://itnavigator.org/
 */

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\Response;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\CertificateSellForm;
use frontend\models\OrderSellForm;
use yii\bootstrap\ActiveForm;
use common\models\Order;
use yii\data\Pagination;
use common\models\User;
use common\models\Broker;

/**
 *  Orders to sell controller
 *
 * @author Vyacheslav Bodrov <bigturtle@i.ua>
 * @since 1.0
 */
class OrdersSellController extends Controller {

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
                            'validation-order-sell-form'
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
     * Display order, add order sell.
     * 
     * @param integer $id orders
     * @return mixed
     */
    public function actionIndex() {

        $modelOrderSellForm = new OrderSellForm();

        $orders = Order::find()->where(['author_id' => Yii::$app->user->identity->id, 'type' => Order::TYPE_SELL]);
        
        if (Yii::$app->user->identity->user_type == User::TYPE_BROKER) {

            $clients_id = Broker::find()->select(['user_id'])
                            ->where(['broker_id' => Yii::$app->user->identity->id])->column();

            $orders->orFilterWhere(['user_id' => $clients_id]);
            $orders->orFilterWhere(['author_id' => Yii::$app->user->identity->id]);
            $orders->where(['type' => Order::TYPE_SELL]);
        }
        $pages = new Pagination(['totalCount' => $orders->count()]);

        $list = $orders->offset($pages->offset)
                ->limit($pages->limit)
                ->all();
        if ($modelOrderSellForm->load(Yii::$app->request->post()) && $modelOrderSellForm->validate()) {

            if ($modelOrderSellForm->save()) {

                Yii::$app->session->setFlash('success', 'Пакет выставлен на продажу.');
                return $this->refresh();
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка сохранения данных');
                return $this->render('index', ['model' => $modelOrderSellForm, 'orders' => $list, 'pages' => $pages]);
            }
        } else {
            return $this->render('index', ['model' => $modelOrderSellForm, 'orders' => $list, 'pages' => $pages]);
        }
    }

    /**
     * Validation Order form adding sell order
     *
     * 
     * @return mixed
     */
    public function actionValidationOrderSellForm() {

        $model = new OrderSellForm();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }

}
