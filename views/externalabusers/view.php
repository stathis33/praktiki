<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;
/** @var yii\web\View $this */
/** @var app\models\Externalabusers $model */

$this->title = $model->IP;
$this->params['breadcrumbs'][] = ['label' => 'Externalabusers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="externalabusers-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'IP' => $model->IP], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'IP' => $model->IP], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    <?= Html::a(
    $model->status == 1 ? 'Μεταφορά σε Blacklist' : 'Μεταφορά σε Whitelist',
    ['toggle-status', 'IP' => $model->IP],
    [
        'class' => 'btn btn-warning',
        'data-method' => 'post',
        'data-confirm' => 'Θέλεις να αλλάξεις το status αυτής της IP;',
    ]
) ?>
    
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
          [
   'attribute' => 'permission',
   'value' => function($model) {
       return \app\models\Permission::findOne($model->permission)->type_permission ?? 'Unknown';
   },
],
           

         
   
            'IP',
            'mask',
            [
    'attribute' => 'status',
    'value' => function ($model) {
    return $model->getStatusName();}
                
],
            'date_added',
            'date_modified',
            'TTL',
            'listed_by',
        ],
    ]) ?>
    
<?php if (!empty($logs)): ?>
    <h3>Ιστορικό αλλαγών</h3>
    <?php
    
    
    echo \yii\grid\GridView::widget([
        'dataProvider' => new ArrayDataProvider([
        'allModels' => $logs,
        'pagination' => false,]),
        'columns' => [
            'attribute',
            [
                'attribute' => 'old_value',
                'label' => 'Παλιά Τιμή',
            ],
            [
                'attribute' => 'new_value',
                'label' => 'Νέα Τιμή',
            ],
            [
                'attribute' => 'changed_by',
                'label' => 'Χρήστης',
            ],
            [
                'attribute' => 'changed_at',
                'label' => 'Ημερομηνία Αλλαγής',
            ],
        ],
    ]);
    ?>
    
    
    
    
<?php endif; ?>



</div>
