<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Bancos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bancos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'valor_ingreso')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'valor_egreso')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idcomprobante')->textInput() ?>

    <?= $form->field($model, 'idcaja')->textInput() ?>

    <?= $form->field($model, 'idanulo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
