<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TercerosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="terceros-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idtercero') ?>

    <?= $form->field($model, 'identificacion') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'apellido') ?>

    <?= $form->field($model, 'telefono') ?>

    <?php // echo $form->field($model, 'direccion') ?>

    <?php // echo $form->field($model, 'idciudad') ?>

    <?php // echo $form->field($model, 'tipo_id') ?>

    <?php // echo $form->field($model, 'razon_social') ?>

    <?php // echo $form->field($model, 'usuariocreacion') ?>

    <?php // echo $form->field($model, 'fecha_creacion') ?>

    <?php // echo $form->field($model, 'fecha_actualizacion') ?>

    <?php // echo $form->field($model, 'anotaciones') ?>

    <?php // echo $form->field($model, 'digitoverificacion') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
