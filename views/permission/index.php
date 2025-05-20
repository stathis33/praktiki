<?php

use app\models\Permission;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\LinkPager;
/** @var yii\web\View $this */
/** @var app\models\PermissionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Permissions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permission-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Permission', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'type_permission',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Permission $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
                    'pager' => [
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
