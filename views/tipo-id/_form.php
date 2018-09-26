<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TipoId */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tipo-id-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tipoidentificacion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codigo')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
