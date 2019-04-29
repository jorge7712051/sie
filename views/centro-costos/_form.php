<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Ciudades;

/* @var $this yii\web\View */
/* @var $model app\models\CentroCostos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="centro-costos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'centrocostos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idciudad')->dropDownList(ArrayHelper::map(Ciudades::find()->where('idanulo=0')->all(), 'idciudad', 'ciudad'))?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
