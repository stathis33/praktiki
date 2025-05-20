<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Whitelist $model */

$this->title = 'Update Whitelist: ' . $model->ip;
$this->params['breadcrumbs'][] = ['label' => 'Whitelists', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ip, 'url' => ['view', 'ip' => $model->ip]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="whitelist-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
