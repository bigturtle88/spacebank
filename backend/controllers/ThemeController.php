<?php

namespace backend\controllers;

use common\components\configdb\ConfigModel;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class ThemeController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow'   => true,
                        'roles'   => ['admin','technik'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $model = new ConfigModel();
        $model->value = Yii::$app->config->get("theme");
        if (Yii::$app->request->post() && Yii::$app->config->set('theme', null, Yii::$app->request->post()))
        {
            return $this->redirect(['/']);
        }
        else
        {
            return $this->render('index', [
                        'thems' => ConfigModel::getThemeList(),
                        'model' => $model,
            ]);
        }
    }

}
