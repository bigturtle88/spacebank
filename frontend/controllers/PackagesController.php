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
use frontend\models\PackagesForm;
use app\base\Model;
use common\models\Certificate;
use yii\data\ActiveDataProvider;
use frontend\models\OfferSearch;
use frontend\models\CertificateSearch;
use frontend\models\PackagesUpdate;
use frontend\models\PackagesDelete;
use common\models\User;
use common\models\Broker;

/**
 *  Packages controller
 *
 * @author Vyacheslav Bodrov <bigturtle@i.ua>
 * @since 1.0
 */
class PackagesController extends Controller {

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

        $model = new PackagesForm();


//        if (Yii::$app->user->identity->user_type == User::TYPE_BROKER) {
//
//            $clients = Broker::find()->where(['broker_id' => Yii::$app->user->identity->id])->all();
//
//            $certificates = Certificate::find();
//
//            $certificates->orFilterWhere(['certificates.user_id' => Yii::$app->user->identity->id,
//                'package_id' => null]);
//            
//            foreach ($clients as $client) {
//
//                $certificates->orFilterWhere(['certificates.user_id' => $client->user_id,
//                    'package_id' => null]);
//                $certificates->orFilterWhere(['certificates.user_id' => $client->consolidator_id,
//                    'package_id' => null]);
//            }
//        } else {
//            $certificates = Certificate::find()->where(['certificates.user_id' => Yii::$app->user->identity->id,
//                'package_id' => null]);
//        }

        $packages = Packages::find()->where(['packages.user_id' => Yii::$app->user->identity->id]);

        if (Yii::$app->user->identity->user_type == User::TYPE_BROKER) {

            $clients_id = Broker::find()->select(['user_id'])
                            ->where(['broker_id' => Yii::$app->user->identity->id])->column();

            $packages->orFilterWhere(['packages.user_id' => $clients_id, 'broker_id' => Yii::$app->user->identity->id]);
        }

        $searchModel = new CertificateSearch();


        $dataProvider = new ActiveDataProvider([
            'query' => $packages,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC, 'company' => SORT_DESC],
            ], 'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        $dataCertificate = $searchModel->search(Yii::$app->request->post());

        $certificatesPost = Yii::$app->request->post();
        $certificatesArray['certificates'] = array();


        if (isset($certificatesPost['certificates'])) {

            foreach ($certificatesPost['certificates'] as $selection) {

                array_push($certificatesArray['certificates'], $selection);

                $filterClubOne = Certificate::find()->where(['certificate_code' => $certificatesArray['certificates'][0]])->one()->club_id;
                $filterClubTwo = Certificate::find()->where(['certificate_code' => $selection])->one()->club_id;

                if ($filterClubOne != $filterClubTwo) {

                    Yii::$app->session->setFlash('error', 'Ошибка сохранения пакета. Были выбраны сертификаты разных клубов. Выберите сертификаты одного клуба и повторите попытку.');
                    return $this->refresh();
                }

                $filterUserOne = Certificate::find()->where(['certificate_code' => $certificatesArray['certificates'][0]])->one()->user_id;
                $filterUserTwo = Certificate::find()->where(['certificate_code' => $selection])->one()->user_id;

                if ($filterUserOne != $filterUserTwo) {

                    Yii::$app->session->setFlash('error', 'Ошибка сохранения пакета. Были выбраны сертификаты разных клиентов. Выберите сертификаты одного клиента и повторите попытку.');
                    return $this->refresh();
                }
            }


            $model->certificates = $certificatesArray['certificates'];


            $model->save();
            Yii::$app->session->setFlash('success', 'Пакет собран.');
            return $this->refresh();
        } else {
            return $this->render('index', [
                        'model' => $model,
                        'dataProvider' => $dataProvider,
                        'dataCertificate' => $dataCertificate,
                        'searchModel' => $searchModel
            ]);
        }
    }

    /**
     * Validation Packages form packages
     *
     * 
     * @return mixed
     */
    public function actionValidationPackagesForm() {
        $model = new PackagesForm();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }

    /**
     * View packages
     *
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {


        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the Offer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Offer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Packages::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Updates an existing Offer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {


        $model = new PackagesUpdate();

        $package = $this->findModel($id);

        $certificates = Certificate::find()->where(['certificates.user_id' => Yii::$app->user->identity->id,
                    'club_id' => $package->club_id, 'package_id' => $package->id])
                ->orWhere(['club_id' => $package->club_id, 'package_id' => null, 'certificates.user_id' => Yii::$app->user->identity->id,]);

        if (Yii::$app->user->identity->user_type == User::TYPE_BROKER) {

            $clients_id = Broker::find()->select(['user_id'])
                            ->where(['broker_id' => Yii::$app->user->identity->id])->column();

            $certificates = Certificate::find()->where(['certificates.user_id' => $clients_id,
                        'club_id' => $package->club_id, 'package_id' => $package->id])
                    ->orWhere(['club_id' => $package->club_id, 'package_id' => null, 'certificates.user_id' => $clients_id]);
        }
        $dataCertificate = new ActiveDataProvider([
            'query' => $certificates,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC],
            ], 'pagination' => [
                'pageSize' => 100,
            ],
        ]);

        $certificatesPost = Yii::$app->request->post();
        $certificatesArray['certificates'] = array();

        if (isset($certificatesPost['certificates'])) {

            foreach ($certificatesPost['certificates'] as $selection) {

                array_push($certificatesArray['certificates'], $selection);

                $filterClubOne = Certificate::find()->where(['certificate_code' => $certificatesArray['certificates'][0]])->one()->club_id;
                $filterClubTwo = Certificate::find()->where(['certificate_code' => $selection])->one()->club_id;

                if ($filterClubOne != $filterClubTwo) {

                    Yii::$app->session->setFlash('error', 'Клубы должны отличаться.');
                    return $this->refresh();
                }
            }

            $model->certificates = $certificatesArray['certificates'];

            $model->package = $package->id;
            $model->save();
            Yii::$app->session->setFlash('success', 'Пакет собран.');
            return $this->refresh();
        } else {

            return $this->render('update', [
                        'model' => $package, 'dataCertificate' => $dataCertificate
            ]);
        }
    }

    /**
     * Deletes an existing Packages model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {

        $model = new PackagesDelete();
        $model->id = $id;

        if ($model->delete() == false) {
            Yii::$app->session->setFlash('error', 'Ошобка удаления пакетов.');
        }
        Yii::$app->session->setFlash('success', 'Пакет Удален.');
        return $this->redirect(['index']);
    }

}
