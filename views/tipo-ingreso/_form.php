<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TipoIngreso */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tipo-ingreso-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ingreso')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'doble')->checkbox(array('label'=>'Habilitación doble') );?>
   
    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
