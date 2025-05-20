<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Log $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="log-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'table_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'primary_key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'attribute')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'old_value')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'new_value')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'changed_at')->textInput() ?>

    <?= $form->field($model, 'changed_by')->textInput() ?>

    <?= $form->field($model, 'old_date')->textInput() ?>

    <?= $form->field($model, 'new_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
