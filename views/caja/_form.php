<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Caja */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="caja-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'valor_ingreso')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'valor_egreso')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'idcomprobante')->textInput() ?>

    <?= $form->field($model, 'idcaja')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
