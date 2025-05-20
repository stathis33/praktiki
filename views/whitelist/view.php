<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;
/** @var yii\web\View $this */
/** @var app\models\Whitelist $model */

$this->title = $model->ip;
$this->params['breadcrumbs'][] = ['label' => 'Whitelists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="whitelist-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'ip' => $model->ip], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'ip' => $model->ip], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ip',
        ],
    ]) ?>
<?php if (!empty($logs)): ?>
    <h3>Ιστορικό αλλαγών</h3>
    <?php
    
    $dataProvider = new \yii\data\ArrayDataProvider([
        'allModels' => $logs,
        'pagination' => false,
    ]);

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
