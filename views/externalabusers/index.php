<?php

use app\models\Externalabusers;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/** @var yii\web\View $this */
/** @var app\models\ExternalabusersSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */


$this->title = 'Externalabusers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="externalabusers-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Externalabusers', ['create'], ['class' => 'btn btn-success']) ?>
    
    
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
$highlightId = Yii::$app->session->getFlash('highlightId');?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model) use ($highlightId) {
        if ($highlightId && $model->IP === $highlightId) {
            return ['class' => 'highlighted-row'];
        }
        return []; 
        
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
   [
'attribute' => 'permission',
 'value' => function($model) {
   return \app\models\Permission::findOne($model->permission)->type_permission ?? 'Unknown';
 },
         'filter' => \app\models\Externalabusers::getPermissionList(),
],


         
            'IP',
            'mask',
            [
     'attribute' => 'status',
    'format' => 'html', // Απαραίτητο για HTML tags
    'value' => function ($model) {
        if ($model->status == 0) {
            return '<span style="color:red; font-weight:bold;">blacklist</span>';
        } else {
            return '<span style="color:green; font-weight:bold;">whitelist</span>';
    }},
    'filter' => \app\models\Externalabusers::getStatusList(),
     ],
            'date_added',
            'date_modified',
            'TTL',
            'listed_by',
            [
    'class' => 'yii\grid\ActionColumn',
    'template' => '{toggle}{view} {update} {delete} ',
    'urlCreator' => function ($action, Externalabusers $model, $key, $index, $column) {
        return Url::toRoute([$action, 'IP' => $model->IP]);
    },
    'buttons' => [
    'toggle' => function ($url, $model, $key) {
        return Html::a(
            'Αλλαγή status',
            ['toggle-status', 'IP' => $model->IP],
            [
                'class' => 'btn btn-sm btn-warning',
                'data-method' => 'post',
                'data-confirm' => 'Θέλεις να αλλάξεις το status της    ' . $model -> IP . ';',
            ]
        );
    },
],

],

                    
        ],
                    'pager' => [
        'class' => \yii\widgets\LinkPager::class,
        'firstPageLabel' => 'Προηγούμενη',
        'lastPageLabel' => 'Επόμενη',
        
    'options' => ['class' => 'pagination justify-content-center'],
    'linkOptions' => ['class' => 'page-link'], 
    'activePageCssClass' => 'page-item active',
    'pageCssClass' => 'page-item',
    
        ],
    ]); ?>
<?php foreach (['success', 'warning', 'error'] as $type): ?>
    <?php if (Yii::$app->session->hasFlash($type)): ?>
        <div class="alert alert-<?= $type ?>">
            <?= Yii::$app->session->getFlash($type) ?>
        </div>
    <?php endif; ?>
<?php endforeach; ?>
<?php
$this->registerCss(<<<CSS
    .highlighted-row {
        background-color: #d1f7c4 !important;
        transition: background-color 0.5s ease;
    }
CSS);
?>
</div>
