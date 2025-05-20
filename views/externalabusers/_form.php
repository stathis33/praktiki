<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Permission;
/** @var yii\web\View $this */
/** @var app\models\Externalabusers $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="externalabusers-form">

    <?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'permission')->dropDownList(
    ArrayHelper::map(Permission::find()->all(),'id','type_permission'),['prompt' => ''] ) ?>
    

    <?= $form->field($model, 'IP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mask')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([
    0 => 'black list',
    1 => 'white list',  
        
],['prompt' => ''] ) ?>

   <?= $form->field($model, 'TTL')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
    
    
    
    </div>

    <?php ActiveForm::end(); ?>

</div>
