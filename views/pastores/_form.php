<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\TipoId;
use app\models\CentroCostos;


/* @var $this yii\web\View */
/* @var $model app\models\Pastores */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pastores-form">

    <?php $form = ActiveForm::begin([
            'method' => 'post',
            'id' => 'formulario-pastores',
            'enableAjaxValidation' => true,
]); ?>

    <div class="col-xs-12 col-lg-6 ">

    <?= $form->field($model, 'tipoid')->dropDownList(ArrayHelper::map(TipoId::find()->where('idanulo=0')->all(), 'id', 'tipoidentificacion'))?>

    <?= $form->field($model, 'cedula')->textInput(['maxlength' => true,'autocomplete'=>'off']) ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-xs-12 col-lg-6 ">

    <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'correo')->textInput(['maxlength' => true]) ?>
    
   <?= $form->field($model, 'centro_costo')->dropDownList(ArrayHelper::map(CentroCostos::find()->where('idanulo=0')->all(), 'idcentrocostos', 'centrocostos'))?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>
</div>
    <?php ActiveForm::end(); ?>

</div>
