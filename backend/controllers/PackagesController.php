<?php

namespace backend\controllers;

use Yii;
use common\models\Packages;
use backend\models\PackagesSearch;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Certificate;
use yii\data\ActiveDataProvider;
use frontend\models\PackagesUpdate;

/**
 * PackagesController implements the CRUD actions for Packages model.
 */
class PackagesController extends Controller
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
     * Lists all Packages models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PackagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->sort->defaultOrder = ['id' => SORT_ASC];
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Packages model.
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
     * Creates a new Packages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Packages();
        
        $model->user_id=(new \yii\db\Query())  
            ->select(['id'])
            ->from('user')
            ->orderBy('id')
            ->limit(1)
            ->scalar();;
        $model->quantity=1;
        $model->created_at = time();
        $model->updated_at = time();
        $model->load(Yii::$app->request->post());
        if ($model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Packages model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->updated_at = time();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Packages model.
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
     * Finds the Packages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Packages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Packages::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    
    public function actionCertificates($id)
    {
        $model = new PackagesUpdate();

        $package = $this->findModel($id);
        $userid=$package->user_id;
        $certificates = Certificate::find()->where(['certificates.user_id' => $package->user_id,
                    'club_id' => $package->club_id, 'package_id' => $package->id])
                ->orWhere(['club_id' => $package->club_id, 'package_id' => null, 'certificates.user_id' => $package->user_id,]);
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

                    Yii::$app->session->setFlash('error', 'Клубы не должны отличаться.');
                    return $this->refresh();
                }
            }


            $model->certificates = $certificatesArray['certificates'];

            $model->package = $package->id;
            $model->save();
            Yii::$app->db->createCommand()->update('packages', [
                    'user_id' => $userid,
                    ],['id' => $package->id])->execute();
            Yii::$app->session->setFlash('success', 'Пакет собран.');
            return $this->redirect(['view', 'id' => $package->id]);
        } else {

            return $this->render('certificates_update', [
                        'model' => $package, 'dataCertificate' => $dataCertificate
            ]);
        }
    }
}
