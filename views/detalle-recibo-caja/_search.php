<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DetalleReciboCajaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="detalle-recibo-caja-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'iddetalle_recibo') ?>

    <?= $form->field($model, 'idtercero') ?>

    <?= $form->field($model, 'valor') ?>

    <?= $form->field($model, 'idtipoingreso') ?>

    <?= $form->field($model, 'idrecibocaja') ?>

    <?php // echo $form->field($model, 'fechacreacion') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
