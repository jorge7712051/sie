<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\CentroCostos;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuarios-form">

    <?php $form = ActiveForm::begin([
            'method' => 'post',
            'id' => 'formulario',
            'enableAjaxValidation' => true,
]);?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nombrecompleto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'centrocosto')->dropDownList(ArrayHelper::map(CentroCostos::find()->Where(['idanulo' => 0])->all(), 'idcentrocostos', 'centrocostos'))?>

    <?= $form->field($model, 'role')->dropDownList( ['1' => 'Administrador',  '0' => 'Usuario']) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
