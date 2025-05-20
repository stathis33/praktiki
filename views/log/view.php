<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Log $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="log-view">

    <h1><?= Html::encode($this->title) ?></h1>

   

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'table_name',
            [
    'attribute' => 'primary_key',
    'value' => function ($model) {
        $decoded = json_decode($model->primary_key, true);
        return is_array($decoded) && isset($decoded['ip']) ? $decoded['ip'] : $model->primary_key;
    },
],
            'attribute',
            'old_value:ntext',
            'new_value:ntext',
            'changed_at',
            'changed_by',
            'old_date',
            'new_date',
        ],
    ]) ?>

</div>
