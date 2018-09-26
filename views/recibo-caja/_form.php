<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ReciboCaja */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="recibo-caja-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idrecibo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'fecha_creacion')->textInput() ?>

    <?= $form->field($model, 'concepto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'valor')->textInput() ?>

    <?= $form->field($model, 'bloqueo')->textInput() ?>

    <?= $form->field($model, 'idcentrocostos')->textInput() ?>

    <?= $form->field($model, 'adjunto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idanulo')->textInput() ?>

    <?= $form->field($model, 'codigo')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
