<?php

use app\models\Whitelist;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\WhitelistSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Whitelists';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="whitelist-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Whitelist', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ip',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Whitelist $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'ip' => $model->ip]);
                 }
            ],
      ], 'pager' => [
        'class' => \yii\widgets\LinkPager::class,
        'firstPageLabel' => 'Προηγούμενη',
        'lastPageLabel' => 'Επόμενη',
        
    'options' => ['class' => 'pagination justify-content-center'],
    'linkOptions' => ['class' => 'page-link'], // για κάθε <a>
    'activePageCssClass' => 'page-item active',
    'pageCssClass' => 'page-item',
    
      


  ],
    ]); ?>
</div>