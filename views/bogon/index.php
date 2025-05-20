<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;


/* @var $this yii\web\View */
/* @var $searchModel app\models\BogonSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = ' Bogon';
?>

<h1><?= Html::encode($this->title) ?></h1>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        'id',
        'permission',
        'protocol',
        'source',
        'destination',
        'range_parameter',
        'range_value', 
        'status',
        'date_added',
        'date_modified',
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


