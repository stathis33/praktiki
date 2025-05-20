<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Externalabusers $model */

$this->title = 'Create Externalabusers';
$this->params['breadcrumbs'][] = ['label' => 'Externalabusers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="externalabusers-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
