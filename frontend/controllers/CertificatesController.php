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
use frontend\models\CertificateForm;
use frontend\models\CertificateSellForm;
use frontend\models\CertificateBuyForm;
use yii\bootstrap\ActiveForm;
use common\models\Certificate;
use yii\data\Pagination;

/**
 * The base of the certificate management controller
 * 
 * @author Vyacheslav Bodrov <bigturtle@i.ua>
 * @since 2.0
 */
class CertificatesController extends Controller {

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
                            'certificates',
                            'validation-certificate-form',
                            'certificate-form'
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

    /*
     * Display the list of certificates, adding the certificates
     *
     * @return mixed
     * 
     */

    public function actionIndex() {

        $modelCertificateForm = new CertificateForm();
        $certificates = Certificate::find()->where(['certificates.user_id' => Yii::$app->user->identity->id]);

        $pages = new Pagination(['totalCount' => $certificates->count()]);
        $list = $certificates
                ->offset($pages->offset)
                ->limit($pages->limit)
                ->all();

        if ($modelCertificateForm->load(Yii::$app->request->post())) {
            //   $modelCertificateForm->certificate_file = UploadedFile::getInstance($modelCertificateForm, 'certificate_file');

   
            if ($modelCertificateForm->validate()) {
                if ($modelCertificateForm->save() /* && $modelCertificateForm->upload() */) {
                    Yii::$app->session->setFlash('success', 'Сертификат успешно создан.');
                    return $this->refresh();
                } else {
                    Yii::$app->session->setFlash('error', 'Ошибка сохранения сертификата.');
                    return $this->render('index', ['model' => $modelCertificateForm, 'certificates' => $list, 'pages' => $pages]);
                }
            } else {
                return $this->render('index', ['model' => $modelCertificateForm, 'certificates' => $list, 'pages' => $pages]);
            }
        } else {
            return $this->render('index', ['model' => $modelCertificateForm, 'certificates' => $list, 'pages' => $pages]);
        }
    }

    /*
     * Validation certificate form adding certificates
     *
     * @return mixed
     * 
     */

    public function actionValidationCertificateForm() {

        $model = new CertificateForm();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }

}
