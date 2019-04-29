<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MembresiaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="membresia-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'identificacion') ?>

    <?= $form->field($model, 'sexo') ?>

    <?= $form->field($model, 'Nombres') ?>

    <?= $form->field($model, 'Apellidos') ?>

    <?= $form->field($model, 'Direccion') ?>

    <?php // echo $form->field($model, 'barrio') ?>

    <?php // echo $form->field($model, 'Telefono') ?>

    <?php // echo $form->field($model, 'Celular') ?>

    <?php // echo $form->field($model, 'Lugar_Nacimiento') ?>

    <?php // echo $form->field($model, 'Fecha_Nacimiento') ?>

    <?php // echo $form->field($model, 'estado_civil') ?>

    <?php // echo $form->field($model, 'conyuge') ?>

    <?php // echo $form->field($model, 'nivel_estudios') ?>

    <?php // echo $form->field($model, 'estudios_tecnicos') ?>

    <?php // echo $form->field($model, 'estudios_profesionales') ?>

    <?php // echo $form->field($model, 'estudios_noformales') ?>

    <?php // echo $form->field($model, 'fecha_bautismo') ?>

    <?php // echo $form->field($model, 'fecha_conversion') ?>

    <?php // echo $form->field($model, 'formacion_teologica') ?>

    <?php // echo $form->field($model, 'cargo_iglesia') ?>

    <?php // echo $form->field($model, 'ministerio_afin') ?>

    <?php // echo $form->field($model, 'cc') ?>

    <?php // echo $form->field($model, 'fecha_ingreso') ?>

    <?php // echo $form->field($model, 'fecha_retiro') ?>

    <?php // echo $form->field($model, 'tipo') ?>

    <?php // echo $form->field($model, 'numero_hijos') ?>

    <?php // echo $form->field($model, 'activo') ?>

    <?php // echo $form->field($model, 'motivo_retiro') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
