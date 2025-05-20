<?php

use app\models\Log;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\LogSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Logs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-index">

    <h1><?= Html::encode($this->title) ?></h1>

    

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'id',
        'table_name',

        [
            'attribute' => 'primary_key',
            'format' => 'raw',
            'value' => function ($model) {
                $decoded = json_decode($model->primary_key, true);
                return is_array($decoded) && isset($decoded['ip'])
                    ? $decoded['ip']
                    : Html::encode($model->primary_key);
            },
        ],

        [
            'attribute' => 'attribute',
            'format' => 'raw',
            'value' => function ($model) {
                return $model->attribute === 'DELETED'
                    ? '<span style="color:red; font-weight:bold;">DELETED</span>'
                    : Html::encode($model->attribute);
            },
        ],

        [
            'attribute' => 'old_value',
            'format' => 'ntext',
            'value' => function ($model) {
                $decoded = json_decode($model->old_value, true);
                return is_array($decoded) && isset($decoded['ip'])
                    ? $decoded['ip']
                    : $model->old_value;
            },
        ],

        [
            'attribute' => 'new_value',
            'format' => 'ntext',
            'value' => function ($model) {
                $decoded = json_decode($model->new_value, true);
                return is_array($decoded) && isset($decoded['ip'])
                    ? $decoded['ip']
                    : $model->new_value;
            },
        ],

        'changed_at',
        'changed_by',
        'old_date',
        'new_date',

        [
            'class' => \yii\grid\ActionColumn::class,
            'template' => '{view}',
            'urlCreator' => function ($action, $model, $key, $index, $column) {
                return Url::toRoute([$action, 'id' => $model->id]);
            },
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


</div>
