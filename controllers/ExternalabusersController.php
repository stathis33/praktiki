<?php

namespace app\controllers;
use Yii;
use app\models\Externalabusers;
use app\models\ExternalabusersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ExternalabusersController implements the CRUD actions for Externalabusers model.
 */
class ExternalabusersController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Externalabusers models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ExternalabusersSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Externalabusers model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
public function actionView($IP)
{
    $model = $this->findModel($IP); // βρίσκει εγγραφή με βάση το πεδίο IP

   $logs = \app\models\Log::find()
    ->where([
        'table_name' => 'externalabusers',
        'primary_key' => $model->getPrimaryKeyForLog()
    ])
    
    ->andWhere(['not in', 'attribute', 'date_modified'])
    ->orderBy(['changed_at' => SORT_DESC])
    ->all();

    return $this->render('view', [
        'model' => $model,
        'logs' => $logs,
    ]);
}



    /**
     * Creates a new Externalabusers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
  public function actionCreate()
{
    $model = new Externalabusers();

    if ($this->request->isPost) {
        if ($model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'IP' => $model->IP]);
        }
    } else {
        $model->loadDefaultValues();
    }

    return $this->render('create', [
        'model' => $model,
    ]);
}


    /**
     * Updates an existing Externalabusers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
  public function actionUpdate($IP)
{
    $model = $this->findModel($IP);

  
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'IP' => $model->IP]);
        }
    return $this->render('update', [
        'model' => $model,
    ]);

}
public function actionToggleStatus($IP) {
    $model = $this->findModel($IP);
    $model->status = $model->status == 1 ? 0 : 1;
    $model->save(false);
    Yii::$app->session->setFlash('success', 'Το status άλλαξε.');
    return $this->redirect(['index']);
}


    /**
     * Deletes an existing Externalabusers model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($IP)
    {
        Yii::$app->session->setFlash('error', 'Δεν επιτρέπεται η διαγραφή .');
    return $this->redirect(['index']);
    }

    /**
     * Finds the Externalabusers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Externalabusers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($IP)
    {
        if (($model = Externalabusers::findOne(['IP' => $IP])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
