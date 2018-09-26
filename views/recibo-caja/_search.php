<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ReciboCajaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="recibo-caja-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idrecibo') ?>

    <?= $form->field($model, 'fecha') ?>

    <?= $form->field($model, 'fecha_creacion') ?>

    <?= $form->field($model, 'concepto') ?>

    <?= $form->field($model, 'valor') ?>

    <?php // echo $form->field($model, 'bloqueo') ?>

    <?php // echo $form->field($model, 'idcentrocostos') ?>

    <?php // echo $form->field($model, 'adjunto') ?>

    <?php // echo $form->field($model, 'idanulo') ?>

    <?php // echo $form->field($model, 'codigo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
