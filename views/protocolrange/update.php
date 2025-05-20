<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Protocolrange $model */

$this->title = 'Update Protocolrange: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Protocolranges', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="protocolrange-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
