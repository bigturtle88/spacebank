<?php

/*
 * @link https://itnavigator.org/
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use frontend\models\ProfileForm;
use common\models\User;
use yii\web\Response;
use yii\bootstrap\ActiveForm;

/**
 *  Profile controller
 *
 * @author Vyacheslav Bodrov <bigturtle@i.ua>
 * @since 1.0
 */
class ProfileController extends Controller {

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
                            'validation-profile-form'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                     [
                        'actions' => ['validation-profile-form'],
                        'allow' => true,
                        'roles' => ['?'],
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
     * Displays  profile of user
     *
     * @return mixed
     */
    public function actionIndex() {

        $modelProfileForm = new ProfileForm();

        $user = User::findOne(['id' => Yii::$app->user->identity->id]);

        $modelProfileForm->setAttributes(Yii::$app->user->identity->attributes);

        if ($modelProfileForm->load(Yii::$app->request->post()) && $modelProfileForm->validate()) {

            $user->username = $modelProfileForm->username;
            $user->email = $modelProfileForm->email;
            $user->fio = $modelProfileForm->fio;
            $user->tel = $modelProfileForm->tel;
            $user->is_individual = $modelProfileForm->is_individual;
            $user->contact = $modelProfileForm->contact;
            $user->firm_name = $modelProfileForm->firm_name;


            if ($user->save()) {
                Yii::$app->session->setFlash('success', 'Вы обновили свой профиль.');
                return $this->refresh();
            }
        } else {

            return $this->render('index', ['model' => $modelProfileForm]);
        }
    }

    /**
     * Validation profile form
     *
     * 
     * @return mixed
     */
    public function actionValidationProfileForm() {

        $model = new ProfileForm();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }

}
