<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DetalleReciboCaja */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="detalle-recibo-caja-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idtercero')->textInput() ?>

    <?= $form->field($model, 'valor')->textInput() ?>

    <?= $form->field($model, 'idtipoingreso')->textInput() ?>

    <?= $form->field($model, 'idrecibocaja')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fechacreacion')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
