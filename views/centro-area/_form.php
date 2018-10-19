<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CentroArea */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="centro-area-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'idarea')->textInput() ?>

    <?= $form->field($model, 'idanulo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
