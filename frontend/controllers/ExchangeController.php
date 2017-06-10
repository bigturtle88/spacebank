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
use frontend\models\Esf;
use yii\data\Pagination;

/**
 * The base of the Exchange
 * 
 * @author Vyacheslav Bodrov <bigturtle@i.ua>
 * @since 1.0
 */
class ExchangeController extends Controller {

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
     * Displays  exchange. Search the database of orders. Display sheet orders.
     *
     * @return mixed
     */
    public function actionIndex() {


        $modelExchangeSearchForm = new Esf();

        if ($modelExchangeSearchForm->load(Yii::$app->request->post()) && $modelExchangeSearchForm->validate()) {

            $orders = Order::find();

            $orders->andFilterWhere(['club_id' => $modelExchangeSearchForm->club_id]);

            if ($modelExchangeSearchForm->country_id) {

                foreach ($modelExchangeSearchForm->country_id as $country_id) {
                    $orders->andFilterWhere(['LIKE', 'country_id', $modelExchangeSearchForm->country_id]);
                }
            }
            if ($modelExchangeSearchForm->apartment_type_id) {
                foreach ($modelExchangeSearchForm->apartment_type_id as $apartment_type_id) {
                    $orders->orFilterWhere(['LIKE', 'apartment_type_id', $apartment_type_id]);
                }
            }


            $orders->andFilterWhere(['type' => $modelExchangeSearchForm->order_type]);

            $orders->andFilterWhere(['>=', 'priced_value', $modelExchangeSearchForm->price_from]);
            $orders->andFilterWhere(['<=', 'priced_value', $modelExchangeSearchForm->price_to]);
            $orders->andFilterWhere(['!=','type',Order::TYPE_CLOSE]);
            $pages = new Pagination(['totalCount' => $orders->count()]);
            $list = $orders->offset($pages->offset)
                    ->limit($pages->limit)
                    ->all();
        } else {
            $orders = Order::find()->where('type!=:type', ['type' => Order::TYPE_CLOSE]);

            $pages = new Pagination(['totalCount' => $orders->count()]);
            $list = Order::find()
                    ->where('type!=:type', ['type' => Order::TYPE_CLOSE])
                    ->offset($pages->offset)
                    ->limit($pages->limit)
                    ->all();
        }

        return $this->render('index', ['orders' => $list, 'model' => $modelExchangeSearchForm, 'pages' => $pages,]);
    }

}
