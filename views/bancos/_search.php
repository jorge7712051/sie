<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BancosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bancos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'valor_ingreso') ?>

    <?= $form->field($model, 'valor_egreso') ?>

    <?= $form->field($model, 'idcomprobante') ?>

    <?= $form->field($model, 'idcaja') ?>

    <?php // echo $form->field($model, 'idanulo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
