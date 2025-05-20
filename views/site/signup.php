<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Εγγραφή';
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="site-signup">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username') ?>
    <?= $form->field($model, 'email')->input('email') ?>
    <?= $form->field($model, 'password')->passwordInput() ?>
    
    <div class="form-group">
        <?= Html::submitButton('Εγγραφή', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
