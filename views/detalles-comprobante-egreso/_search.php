<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DetallesComprobanteEgresoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="detalles-comprobante-egreso-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'iddetalle') ?>

    <?= $form->field($model, 'idtercero') ?>

    <?= $form->field($model, 'valor') ?>

    <?= $form->field($model, 'idcomprobanteegreso') ?>

    <?= $form->field($model, 'idconcepto') ?>

    <?php // echo $form->field($model, 'fechacreacion') ?>

    <?php // echo $form->field($model, 'adjunto') ?>

    <?php // echo $form->field($model, 'subtotal') ?>

    <?php // echo $form->field($model, 'total') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
