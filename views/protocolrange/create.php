<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Protocolrange $model */

$this->title = 'Create Protocolrange';
$this->params['breadcrumbs'][] = ['label' => 'Protocolranges', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="protocolrange-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
