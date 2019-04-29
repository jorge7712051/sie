<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Membresia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="membresia-form">

    <div class="row">    

    <?php $form = ActiveForm::begin(); ?>

     <div class="col-xs-12 col-lg-6 ">

    <?= $form->field($model, 'identificacion')->textInput() ?>

    <?= $form->field($model, 'sexo')->radioList(array('M'=>'M','F'=>'F')); ?>

    <?= $form->field($model, 'Nombres')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Apellidos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Direccion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'barrio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Telefono')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Celular')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Lugar_Nacimiento')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Fecha_Nacimiento')->widget(DatePicker::classname(), [
                'options' => ['autocomplete'=>"off",'placeholder' => 'Fecha de nacimiento'],
                                'pluginOptions' => [
                                'autoclose'=>true,
                                'format' => 'yyyy-mm-dd',
                                ]
    ]);?>

    <?= $form->field($model, 'estado_civil')->dropDownList(
            ['soltero' => 'Soltero', 'casado' => 'Casado', 'Union Libre' => 'Union Libre', 'separado' => 'Separado']
            ); ?>

    <?= $form->field($model, 'conyuge')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nivel_estudios')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estudios_tecnicos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estudios_profesionales')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estudios_noformales')->textarea(['rows' => 6]) ?>

    </div>
    <div class="col-xs-12 col-lg-6 ">


    <?= $form->field($model, 'fecha_bautismo')->widget(DatePicker::classname(), [
                'options' => ['autocomplete'=>"off",'placeholder' => 'Fecha de bautismo'],
                                'pluginOptions' => [
                                'autoclose'=>true,
                                'format' => 'yyyy-mm-dd',
                                ]
    ]);?>

    <?= $form->field($model, 'fecha_conversion')->widget(DatePicker::classname(), [
                'options' => ['autocomplete'=>"off",'placeholder' => 'Fecha de conversion'],
                                'pluginOptions' => [
                                'autoclose'=>true,
                                'format' => 'yyyy-mm-dd',
                                ]
    ]);?>

    <?= $form->field($model, 'formacion_teologica')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'cargo_iglesia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ministerio_afin')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'fecha_ingreso')->widget(DatePicker::classname(), [
                'options' => ['autocomplete'=>"off",'placeholder' => 'Fecha ingreso'],
                                'pluginOptions' => [
                                'autoclose'=>true,
                                'format' => 'yyyy-mm-dd',
                                ]
    ]);?>

        <?= $form->field($model, 'fecha_retiro')->widget(DatePicker::classname(), [
                'options' => ['autocomplete'=>"off",'placeholder' => 'Fecha retiro'],
                                'pluginOptions' => [
                                'autoclose'=>true,
                                'format' => 'yyyy-mm-dd',
                                ]
    ]);?>

    <?= $form->field($model, 'tipo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'numero_hijos')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'activo')->radioList(array('0'=>'SI','1'=>'NO')); ?>
    
    <?= $form->field($model, 'motivo_retiro')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar Menbresia', ['class' => 'btn btn-success']) ?>
    </div>
    </div>
    </div>

    

    <?php ActiveForm::end(); ?>

</div>
