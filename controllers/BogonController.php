<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\BogonSearch;

class BogonController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new BogonSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}