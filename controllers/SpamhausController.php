<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\SpamhausSearch;

class SpamhausController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new SpamhausSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}