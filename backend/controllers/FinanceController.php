<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use backend\models\FinanceModel;
use yii\filters\VerbFilter;


class FinanceController extends Controller
{
    /**
     * @inheritdoc
     */
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
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        if (Yii::$app->request->post())
        {
            foreach(Yii::$app->request->post() as $k=>$v){
               FinanceModel::saveFinance($k,$v);
            }
            return $this->redirect(['/finance']);
        }

        {
            return $this->render('index', [
                        'rows' => FinanceModel::getFinanceList(),
            ]);
        }
    }

}
