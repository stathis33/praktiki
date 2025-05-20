<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Externalabusers $model */

$this->title = 'Update Externalabusers: ' . $model->IP;
$this->params['breadcrumbs'][] = ['label' => 'Externalabusers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->IP, 'url' => ['view', 'IP' => $model->IP]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="externalabusers-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
