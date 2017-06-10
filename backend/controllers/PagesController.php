<?php

namespace backend\controllers;

use backend\models\PagesModel;
use common\components\UrlModel;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * PagesController implements the CRUD actions for PagesModel model.
 */
class PagesController extends Controller
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
            'verbs'  => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all PagesModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        /* $searchModel = new PagesModelSearch();
          $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        ]);*/
        $dataProvider = new ActiveDataProvider([
            'query'      => PagesModel::find(),
            'pagination' => false,
        ]);
        $dataProvider->sort->defaultOrder = ['id' => SORT_ASC];

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PagesModel model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new PagesModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PagesModel();
        $url   = new UrlModel();
        if ($model->load(Yii::$app->request->post()) && $model->save() && $url->load(Yii::$app->request->post()) && $url->save())
        {
            $url->link('page', $model);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'url'   => $url,
            ]);
        }
    }

    /**
     * Updates an existing PagesModel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $url   = $model->url;


        if ($model->load(Yii::$app->request->post()) && $model->save() && $url->load(Yii::$app->request->post()) && $url->save())
        {
            $url->link('page', $model);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'url'   => $url,
            ]);
        }
    }

    /**
     * Deletes an existing PagesModel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PagesModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PagesModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PagesModel::findOne($id)) !== null)
        {
            return $model;
        }
        else
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
