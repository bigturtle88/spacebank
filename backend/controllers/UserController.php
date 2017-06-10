<?php

namespace backend\controllers;

use Yii;
use backend\models\UserForm as User;
use backend\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;


/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller {

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
                        'roles'   => ['admin','finance_moderator'],
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

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->sort->defaultOrder = ['username' => SORT_ASC];
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'brokers' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->preperSave() && $model->save())
        {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        else
        {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->preperSave() && $model->save())
        {
            $selrow='user_id';
            if($model->user_type=='Consolidator')$selrow='consolidator_id';
            Yii::$app->db->createCommand()->update('broker', [
                    'is_active' => 0,
                    ],[$selrow => $id])->execute();
            if(isset(Yii::$app->request->post()['brokers'])){
            $brokersPost = Yii::$app->request->post()['brokers'];
            if(isset(Yii::$app->request->post()['procent']))$procentPost = Yii::$app->request->post()['procent'];
            foreach ($brokersPost as $k=>$v) {
               $ready=(new \yii\db\Query())  
                ->select(['id'])
                ->from('broker')
                ->where(['broker_id' => $v, $selrow => $id])
                ->scalar();
                if(!$ready){
                    Yii::$app->db->createCommand()->insert('broker', [
                    'broker_id' => $v,
                    $selrow => $id,
                    'procent' => $procentPost[$k],
                    'is_active' => 1,
                    ])->execute();
                }
                else{
                    Yii::$app->db->createCommand()->update('broker', [
                    'is_active' => 1,
                    'procent' => $procentPost[$k]
                    ],[$selrow => $id, 'broker_id' => $v])->execute();
                }
                
            }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }
        else
        {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null)
        {
            return $model;
        }
        else
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
