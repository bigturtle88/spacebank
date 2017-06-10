<?php

/*
 * @link https://itnavigator.org/
 */

namespace frontend\controllers;

use Yii;
use common\models\Offer;
use frontend\models\OfferSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\OfferBuyForm;
use frontend\models\OfferSellForm;
use yii\filters\AccessControl;
use common\models\Order;
use common\models\Certificate;
use yii\base\InvalidParamException;
use yii\web\Response;
use yii\bootstrap\ActiveForm;
use frontend\models\OrderSellForm;
use yii\data\ActiveDataProvider;
use frontend\models\OfferTradeForm;
use common\models\User;
use backend\models\LogDeals;
use backend\models\LogMoney;
use common\models\CurrenciesQuery;
use common\models\Packages;

/**
 * The base of the offers management controller
 * 
 * @author Vyacheslav Bodrov <bigturtle@i.ua>
 * @since 1.0
 */
class OffersController extends Controller {

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
                            'offer-buy-form',
                            'offer-sell-form',
                            'validation-offer-buy-form',
                            'validation-offer-sell-form',
                            'offer-status-update',
                            'offer-trade',
                            'validation-offer-trade-form',
                            'offer-transaction',
                            'offer-pending'
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
     * Display the list offers
     *
     * @return mixed
     */
    public function actionIndex() {

        //SELECT * from `offers` where `id` in (SELECT MAX(`id`) as `id` FROM `offers` group by `source_id`)

        $params = Yii::$app->request->queryParams;
        $query2 = (new \yii\db\Query())->select('MAX(id) AS id')->from('offers')->groupBy('source_id');
        $query = Offer::find();

        $query->andFilterWhere(['or',
                ['seller_id' => Yii::$app->user->identity->id],
                ['buyer_id' => Yii::$app->user->identity->id],
                ['user_id' => Yii::$app->user->identity->id],
                ]
        );
        $query->andFilterWhere(['id' => $query2]);
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

    /**
     * Display forms adding the buy offer
     * 
     * @param integer $id orders
     * @return mixed
     * @throws HttpException
     */
    public function actionOfferBuyForm($id = null) {

        $modelOfferBuyForm = new OfferBuyForm();
        $order = Order::findOne($id);
        if (!$order) {
            throw new \yii\web\HttpException(404, 'Page not found');
        }
        $packages = Packages::findOne(['id' => $order->source_id]);
        if (!$packages) {
            throw new \yii\web\HttpException(404, 'Page not found');
        }

        if ($order->user_id == Yii::$app->user->identity->id) {

            return $this->renderAjax('/site/info', ['message' => Yii::t('frontend/messages', 'You can not buy your certificate')]);
        }
        $modelOfferBuyForm->source_id = $order->id;
        $modelOfferBuyForm->buyer_id = Yii::$app->user->identity->id;
        $modelOfferBuyForm->seller_id = $order->author_id;
        $modelOfferBuyForm->bid = $order->priced_value;
        $modelOfferBuyForm->author_id = Yii::$app->user->identity->id;
        $modelOfferBuyForm->user_id = $packages->user_id;
        $modelOfferBuyForm->type = Order::TYPE_BUY;
        if ($modelOfferBuyForm->load(Yii::$app->request->post()) && $modelOfferBuyForm->validate()) {
            $modelOfferBuyForm->status = 1;
            $modelOfferBuyForm->expertise = 0;
            $modelOfferBuyForm->priced_currency = $order->priced_currency;

            if ($modelOfferBuyForm->save()) {
                Yii::$app->session->setFlash('success', Yii::t('frontend/messages', 'Request sent'));
                return $this->redirect('index');
            } else {
                Yii::$app->session->setFlash('error', Yii::t('frontend/messages', 'Error sending the application'));
            }
        } elseif (Yii::$app->request->isAjax) {
            return $this->renderAjax('offerBuyForm', ['model' => $modelOfferBuyForm]);
        } else {

            return $this->render('offerBuyForm', ['model' => $modelOfferBuyForm]);
        }
    }

    /**
     * Validation offer form adding buy offer
     *
     * 
     * @return mixed
     */
    public function actionValidationOfferBuyForm() {

        $model = new OfferBuyForm();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }

    /**
     * 
      Changing the status of the offer
     *
     * @param integer $id offer, integer $status offer
     * @return mixed
     * @throws HttpException
     */
    public function actionOfferStatusUpdate($id, $status) {

        $model = $this->findModel($id);

//        if (!$model || ($model->author_id != Yii::$app->user->identity->id && $status == Offer::STATUS_CANCEL)) {
//            throw new \yii\web\HttpException(404, 'Page not found');
//        }
//        if ($model->author_id != Yii::$app->user->identity->id && $status != Offer::STATUS_CANCEL && $status != Offer::STATUS_NEW) {
//            throw new \yii\web\HttpException(404, 'Page not found');
//        }
        $model->status = (int) $status;

        if ($model->save()) {

            Yii::$app->session->setFlash('success', 'Статус успешно изменен.');
            return $this->redirect('/offers');
        } else {
            Yii::$app->session->setFlash('error', 'Ошибка изменения статуса.');
            return $this->redirect('/offers');
        }
    }

    /**
     * Finds the Offer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Offer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Offer::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Display forms adding the sell offer
     * 
     * @param integer $id orders
     * @return mixed
     * @throws HttpException
     */
    public function actionOfferSellForm($id = null) {

        $modelOfferSellForm = new OfferSellForm();

        $order = Order::findOne($id);

        if (!$order) {
            throw new \yii\web\HttpException(404, 'Page not found');
        }

        if ($order->user_id == Yii::$app->user->identity->id) {

            return $this->renderAjax('/site/info', ['message' => 'Вы не можете предложить себе']);
        }

        $modelOfferSellForm->order_id = $order->id;
        $modelOfferSellForm->buyer_id = $order->author_id;
        $modelOfferSellForm->seller_id = Yii::$app->user->identity->id;
        $modelOfferSellForm->author_id = Yii::$app->user->identity->id;
        $modelOfferSellForm->user_id = $order->user_id;
        $modelOfferSellForm->type = Order::TYPE_SELL;
        if ($modelOfferSellForm->load(Yii::$app->request->post()) && $modelOfferSellForm->validate()) {

            $modelOrder = new Order();


            $modelOrder->type = Order::TYPE_SELL;

            $modelOrder->is_active = 0;

            $package = Packages::find()->where(['id' => $modelOfferSellForm->source_id])->one();
            $modelOrder->user_id = $package->user_id;
            $modelOrder->club_id = $package->club_id;
            $modelOrder->country_id = $package->country_id;
            $modelOrder->apartment_type_id = $package->apartment_type_id;
            $modelOrder->season_id = $package->season_id;
            $modelOrder->author_id = Yii::$app->user->identity->id;
            $modelOrder->interval = 0;
            $modelOrder->interval_numbers = 0;
            $modelOrder->apartment_number = 0;
            $modelOrder->bonus_weeks = 0;

            $modelOrder->created_at = time();
            $modelOrder->updated_at = time();


            $modelOrder->price_show = 0;
            $modelOrder->priced_value = $modelOfferSellForm->bid;

            $modelOrder->source_id = $modelOfferSellForm->source_id;
            $modelOrder->priced_currency = $modelOfferSellForm->priced_currency;

            $modelOrder->save();

            $modelOfferSellForm->source_id = $modelOrder->id;
            $modelOfferSellForm->status = Offer::STATUS_NEW;
            $modelOfferSellForm->expertise = 0;

            if ($modelOfferSellForm->save()) {
                Yii::$app->session->setFlash('success', 'Заявка отправленна.');
                return $this->redirect('index');
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка отправки заявки.');
            }
        } elseif (Yii::$app->request->isAjax) {
            return $this->renderAjax('offerSellForm', ['model' => $modelOfferSellForm]);
        } else {

            return $this->render('offerSellForm', ['model' => $modelOfferSellForm]);
        }
    }

    /**
     * Validation offer form adding sell offer
     *
     * 
     * @return mixed
     */
    public function actionValidationOfferSellForm() {

        $model = new OfferSellForm();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }

    /**
     * Display the trade list offer, trade form
     *
     * @return mixed
     */
    public function actionOfferTrade($id) {



        $offer = Offer::findOne($id);
        $offer->status = Offer::STATUS_TRADE;
        $offer->save();
        if (!$offer) {
            throw new \yii\web\HttpException(404, 'Page not found');
        }
        $modelOfferTradeForm = new OfferTradeForm();

        $query = Offer::find();
        $query->filterWhere([
            'source_id' => $offer->source_id,
        ]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $modelOfferTradeForm->offer_id = $offer->id;
        $modelOfferTradeForm->bid = $offer->bid;
        $modelOfferTradeForm->user_id = $offer->user_id;
        if ($modelOfferTradeForm->load(Yii::$app->request->post()) && $modelOfferTradeForm->validate()) {

            $modelOfferTradeForm->buyer_id = $offer->buyer_id;
            $modelOfferTradeForm->seller_id = $offer->seller_id;
            $modelOfferTradeForm->source_id = $offer->source_id;
            $modelOfferTradeForm->buyer_id = $offer->buyer_id;
            $modelOfferTradeForm->user_id = $offer->user_id;
            $modelOfferTradeForm->author_id = Yii::$app->user->identity->id;
            $modelOfferTradeForm->status = Offer::STATUS_NEW;
            $modelOfferTradeForm->type = $offer->type;
            $modelOfferTradeForm->expertise = 0;
            $modelOfferTradeForm->save();

            Yii::$app->session->setFlash('success ', 'Заявка отправленна.');
            return $this->redirect('index');
        } else {
            return $this->renderAjax('offerTrade', [
                        'dataProvider' => $dataProvider,
                        'model' => $modelOfferTradeForm
            ]);
        }
    }

    /**
     * Validation offer form adding trade offer
     *
     * 
     * @return mixed
     */
    public function actionValidationOfferTradeForm() {

        $model = new OfferTradeForm();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }

    /**
     * 
      Buy certificate and finish offer
     *
     * @param integer $id offer
     * @return mixed
     * @throws HttpException
     */
    public function actionOfferTransaction($id) {

        $model = new Offer();
        $model = $model->findOne($id);

        if (!$model || ($model->author_id == Yii::$app->user->identity->id)) {

            throw new \yii\web\HttpException(404, 'Page not found');
        }

        $userBuyer = new User();
        $userBuyer = $userBuyer->findOne($model->buyer_id);
        $userSeller = new User();
        $userSeller = $userSeller->findOne(Yii::$app->user->identity->id);

        if ($userBuyer->money < $model->bid) {
            Yii::$app->session->setFlash('error', 'Недостаточно средств.');
            return $this->redirect('/offers');
        }

        $order = new Order();
        $order = $order->findOne($model->source_id);

        $packages = new Packages();
        $packages = $packages->findOne($order->source_id);
        $packages->user_id = $model->buyer_id;
       $packages->broker_id = null;

        $order->type = Order::TYPE_CLOSE;
        $model->status = Offer::STATUS_OK;
        $currency = CurrenciesQuery::currencyCourse($order->priced_currency);

        $userSeller->money = $userSeller->money + ( $model->bid / $currency );
        $userBuyer->money = $userBuyer->money - ( $model->bid / $currency);

        $logDeals = new LogDeals();

        $logDeals->setAttributes($model->attributes);



        $logDeals->sum = $model->bid;
        $logDeals->sum_system = 0;

        $logDeals->packages_id = $packages->id;
        $logDeals->club_id = $packages->club_id;
        $logDeals->country_id = $packages->country_id;
        $logDeals->apartment_type_id = $packages->apartment_type_id;
        $logDeals->season_id = $packages->season_id;

        $logDeals->priced_value = $model->bid;

        $logDeals->priced_currency = $order->priced_currency;
        $logDeals->virtual = 0;
        $logDeals->created_at = time();
        $logDeals->updated_at = time();



        if ($packages->save(false) && $model->save(false) && $order->save(false) && $userSeller->save(false) && $userBuyer->save(false)) {

            Certificate::updateAll(['user_id' => $model->buyer_id, 'broker_id' => null], 'package_id=' . $packages->id);
            $logDeals->save(false);
            $logMoney1 = new LogMoney();
            $logMoney1->user_id = $model->buyer_id;
            $logMoney1->sum = $model->bid / $currency;
            $logMoney1->tip = Order::TYPE_BUY;
            $logMoney1->status = 'Executed';
            $logMoney1->created_at = time();
            $logMoney1->updated_at = time();
            $logMoney2 = new LogMoney();
            $logMoney2->user_id = $model->seller_id;
            $logMoney2->sum = -1 * $model->bid;
            $logMoney2->tip = Order::TYPE_SELL;
            $logMoney2->status = 'Executed';
            $logMoney2->created_at = time();
            $logMoney2->updated_at = time();
            $logMoney1->save();
            $logMoney2->save();
            Yii::$app->session->setFlash('success', 'Статус успешно изменен.');
            return $this->redirect('/offers');
        } else {
            Yii::$app->session->setFlash('error', 'Ошибка изменения статуса.');
            return $this->redirect('/offers');
        }
    }

    /**
     * 
      Buy certificate and pending user
     *
     * @param integer $id offer
     * @return mixed
     * @throws HttpException
     */
    public function actionOfferPending($id) {

        $model = new Offer();
        $model = $model->findOne($id);

        if (!$model || ($model->author_id == Yii::$app->user->identity->id)) {

            throw new \yii\web\HttpException(404, 'Page not found');
        }
        $userBuyer = new User();
        $userBuyer = $userBuyer->findOne($model->buyer_id);
        $userSeller = new User();
        $userSeller = $userSeller->findOne($model->seller_id);
        if ($userBuyer->money < $model->bid) {
            Yii::$app->session->setFlash('error', 'Недостаточно средств.');
            return $this->redirect('/offers');
        }

        $model->status = Offer::STATUS_PENDING;

        if ($model->save(false)) {

            Yii::$app->session->setFlash('success', 'Статус успешно изменен.');
            return $this->redirect('/offers');
        } else {
            Yii::$app->session->setFlash('error', 'Ошибка изменения статуса.');
            return $this->redirect('/offers');
        }
    }

}
