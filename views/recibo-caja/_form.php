<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use kartik\number\NumberControl;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\ReciboCaja */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row"> 
    <div class="recibo-caja-form">

    <?php $form = ActiveForm::begin([
       'method'=>'post',
       'id'=>'formulario-comprobante-egreso',
       'enableClientValidation'=>true,
    ]); ?>

    <div class="col-xs-12 col-lg-6 ">
    <?= $form->field($model, 'idrecibo')->textInput(['maxlength' => true]) ?>

      <?= $form->field($model, 'comprobante')->widget(FileInput::classname(), [
                      'options' => ['accept' => 'image/*,application/pdf'],  
                      'pluginOptions' => [
                      'showUpload' => false,
                    ],
      ]); ?>

    

    </div>

    <div class="col-xs-12 col-lg-6 ">

    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'fecha_creacion')->textInput() ?>

    <?= $form->field($model, 'concepto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'valor')->textInput() ?>

    <?= $form->field($model, 'bloqueo')->textInput() ?>

    <?= $form->field($model, 'idcentrocostos')->textInput() ?>    

    <?= $form->field($model, 'idanulo')->textInput() ?>

    <?= $form->field($model, 'codigo')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
</div>
    <?php ActiveForm::end(); ?>

</div>
</div>