<?php

namespace app\controllers;

use app\models\Whitelist;
use app\models\WhitelistSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * WhitelistController implements the CRUD actions for Whitelist model.
 */
class WhitelistController extends Controller
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
     * Lists all Whitelist models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new WhitelistSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Whitelist model.
     * @param string $ip Ip
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
  public function actionView($ip)
{
    // Δοκίμασε να βρεις το μοντέλο. Αν δεν υπάρχει, μην κάνεις throw.
    $model = Whitelist::findOne(['ip' => $ip]);

    $allLogs = \app\models\Log::find()
        ->where(['table_name' => 'whitelist'])
        ->andWhere(['like', 'primary_key', '"ip":"' . $ip . '"'])
        ->orderBy(['changed_at' => SORT_DESC])
        ->all();
if ($model === null) {
        $model = new \app\models\Whitelist();
        $model->ip = $ip;
    }

    return $this->render('view', [
        'model' => $model ?? new \app\models\Whitelist(['ip' => $ip]),
        'logs' => $allLogs,
    ]);
}


    /**
     * Creates a new Whitelist model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Whitelist();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'ip' => $model->ip]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Whitelist model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $ip Ip
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($ip)
    {
        $model = $this->findModel($ip);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ip' => $model->ip]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Whitelist model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $ip Ip
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
  public function actionDelete($ip)
{
    $this->findModel($ip)->delete();
    return $this->redirect(['index']);
}


    /**
     * Finds the Whitelist model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $ip Ip
     * @return Whitelist the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ip)
    {
        if (($model = Whitelist::findOne(['ip' => $ip])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
