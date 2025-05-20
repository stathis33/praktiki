<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\LogSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="log-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'table_name') ?>

    <?= $form->field($model, 'primary_key') ?>

    <?= $form->field($model, 'attribute') ?>

    <?= $form->field($model, 'old_value') ?>

    <?php // echo $form->field($model, 'new_value') ?>

    <?php // echo $form->field($model, 'changed_at') ?>

    <?php // echo $form->field($model, 'changed_by') ?>

    <?php // echo $form->field($model, 'old_date') ?>

    <?php // echo $form->field($model, 'new_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
