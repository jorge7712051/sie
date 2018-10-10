<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PastoresSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pastores-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'cedula') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'direccion') ?>

    <?= $form->field($model, 'telefono') ?>

    <?= $form->field($model, 'correo') ?>

    <?php // echo $form->field($model, 'idanulo') ?>

    <?php // echo $form->field($model, 'tipoid') ?>

    <?php // echo $form->field($model, 'centro_costo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
